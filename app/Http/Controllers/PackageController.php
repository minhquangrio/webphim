<?php
//=====QUẢN LÝ GÓI VIP=====

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Category;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    public function index()
    {

        $package = Package::all();
        return view('pages.package', compact('package'));
    }
    public function check_out(Request $request, $id)
    {
        if (auth()->check()) {
            // Lấy package_id từ request POST
            $packageId = $request->input('pack_id');

            // Tìm gói theo package_id
            $package = Package::find($packageId);

            // Kiểm tra xem gói có tồn tại không
            if ($package) {
                // Lấy số tháng từ request
                $months = $request->input('months');

                // Tính toán tổng tiền
                $subTotal = $package->price * $months;

                // Thông báo thành công nếu là gói 12 tháng
                $successMessage = '';
                if ($months == 12) {
                    $subTotal = $package->price * 10; // Giảm giá 2 tháng
                    $successMessage = '2 months FREE for annual billing';
                }

                return view('pages.check_out', compact('package', 'months', 'subTotal', 'successMessage'));
            } else {
                // Xử lý trường hợp gói không tồn tại
                return redirect()->back()->with('error', 'Gói không tồn tại');
            }
        } else {
            return redirect()->back()->with('success', 'Hãy đăng nhập trước khi mua gói nhé!');
        }
    }

    public function vnpay_payment(Request $request)
    {
        $data = $request->all();
        $code_package = rand(11, 9999);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/";
        $vnp_TmnCode = "NGX9RNAY"; //Mã website tại VNPAY 
        $vnp_HashSecret = "KNALPBFLKAZQCBUBQEGTKYHBRVWECGUB"; //Chuỗi bí mật

        $vnp_TxnRef = $code_package; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán gói VIP';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $data['subTotal_vnpay'] * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        // $vnp_ExpireDate = $expire;

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
            // "vnp_ExpireDate" => $vnp_ExpireDate
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00'
            ,
            'message' => 'success'
            ,
            'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }

        // Lấy ID người dùng hiện tại
        $userId = auth()->id();

        // Tìm người dùng dựa trên ID
        $user = User::find($userId);
        $user->isVip == 1;
        Auth::login($user);
        return redirect()->to('/')->with('success', 'Bạn đã mua gói thành công!');

    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cập nhật số tháng thành công!');
        }
    }

    // public function update_isVip(Request $request)
    // {
    //     $id = Auth::id();
    //     $user = User::find($id);

    //     if ($user) {
    //         $user->isVip = 1;
    //         $user->save();
    //         Auth::login($user);
    //     }

    //     return view('homepage')->with('success', 'Mua gói thành công!');
    // }
}