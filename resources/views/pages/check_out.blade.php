{{-- TRANG PACKAGE CỦA WEBSITE XEM PHIM --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- checkout.blade.php -->
<section class="text-center">
    <h4 class="mb-4"><strong>XÁC NHẬN VÀ THANH TOÁN</strong></h4>

    @if(\Session::has('error'))
        <div class="alert alert-danger">{{ \Session::get('error') }}</div>
        {{ \Session::forget('error') }}
    @endif
    @if(\Session::has('success'))
        <div class="alert alert-success">{{ \Session::get('success') }}</div>
        {{ \Session::forget('success') }}
    @endif

    <div class="card border border-primary">
        <div class="card-header bg-white py-3">
            <p class="text-uppercase small mb-2"><strong>{{ $package->name }}</strong></p>
            <h5 class="mb-0">{{ number_format($package->price) }}đ/tháng</h5>
        </div>

        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    @if ($package->quality == 0)
                        Quality up to UHD
                    @elseif ($package->quality == 1)
                        Quality up to 2K
                    @elseif ($package->quality == 2)
                        Quality up to 4K
                    @endif
                </li>
                <li class="list-group-item">
                    @if ($package->chat == 0)
                        No support chat
                    @elseif ($package->chat == 1)
                        Support chat
                    @endif
                </li>
                <li class="list-group-item">
                    @if ($package->hotMovie == 0)
                        Không được xem trước phim HOT
                    @elseif ($package->hotMovie == 1)
                        Xem phim HOT sau tài khoản Platinum
                    @elseif ($package->hotMovie == 2)
                        Được xem phim HOT trước khi công chiếu
                    @endif
                </li>
            </ul>
        </div>
    </div>

    <div class="form-group">
        <label>Số tháng:</label>
        <select class="form-control" name="months" id="months">
            @for ($i = 1; $i <= 12; $i++)
                <option value="{{ $i }}">{{ $i }} tháng</option>
            @endfor
        </select>
    </div>
    
    <div class="form-group">
        <label>Tổng tiền:</label>
        <span name="subTotal" id="subTotal">{{($subTotal) }}đ</span>
    </div>

    <div>Chọn phương thức thanh toán:

        {{-- Phương thức thanh toán PayPal --}}
        <div class="col-md-6">
            {{-- <div id="paypal-button"></div> --}}
            <form action="{{ route('processTransaction') }}" method="POST">
                @csrf
                <button type="submit"><img src="{{asset('imgs/kisspng-logo-paypal.jpg')}}" style="shape: pill; width: 100px" alt=""></button>
                <input type="hidden" id="vnd_to_usd" name="vnd_to_usd">
            </form>
        </div><br><br>

        {{-- Phương thức thanh toán VNPAY --}}
        <div class="col-md-6">
            <form action="{{route('vnpay_payment')}}" method="POST">
            @csrf
            <input type="hidden" name="subTotal_vnpay" id="subTotal_vnpay" value="{{$subTotal}}">
            <button class="btn btn-primary" style="width: 20px; shape: pill" type="submit" name="redirect"><img src="{{asset('imgs/0oxhzjmxbksr1686814746087.png')}}" style="shape: pill; width: 100px" alt=""></button>
            </form>
        </div><br>

    </div>
</section>

<script>
    // Tính toán và hiển thị tổng tiền mặc định khi trang được tải lên
    document.addEventListener('DOMContentLoaded', function() {
    var months = parseInt(document.getElementById('months').value); // Lấy giá trị số tháng đã chọn mặc định
    var price = parseInt('{{ $package->price }}'); // Lấy giá trị giá gói từ blade template
    var subTotal = months * price; // Tính toán tổng tiền
    document.getElementById('subTotal').textContent = subTotal.toLocaleString(); // Cập nhật giá trị tổng tiền
    document.getElementById('subTotal_vnpay').value = subTotal;
    var vnd_to_usd = subTotal / 23755; // Tính giá trị USD tương ứng
    document.getElementById('vnd_to_usd').value = vnd_to_usd.toFixed(2);
    });
    
    // Lắng nghe sự kiện thay đổi của phần tử select
    document.getElementById('months').addEventListener('change', function() {
    var months = parseInt(this.value); // Lấy giá trị số tháng đã chọn
    var price = parseInt('{{ $package->price }}'); // Lấy giá trị giá gói từ blade template
    var subTotal = months * price; // Tính toán tổng tiền
    document.getElementById('subTotal').textContent = subTotal.toLocaleString(); // Cập nhật giá trị tổng tiền
    document.getElementById('subTotal_vnpay').value = subTotal;
    var vnd_to_usd = subTotal / 23755; // Tính giá trị USD tương ứng
    document.getElementById('vnd_to_usd').value = vnd_to_usd.toFixed(2);
    });
</script>

{{-- Thanh toán PayPal --}}
{{-- <script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
    paypal.Button.render({
        env: 'sandbox',
        client: {
            sandbox: 'AfaGWA35hFQgGc6L7PybDkhc0d-0Px75-9GgcK7shyM1Qi5JSgEVibLcU-6JUgpU5Uy9H0Hu9-E4LlV2',
            production: 'demo_production_client_id'
        },
        locale: 'en_US',
        style: {
            size: 'small',
            color: 'gold',
            shape: 'pill',
        },
        commit: true,
        payment: function(data, actions){
            return actions.payment.create({
                transactions: [{
                    amount: {
                        total: document.getElementById('vnd_to_usd').value,
                        currency: 'USD'
                    }
                }]
            });
        },
        onAuthorize: function(data, actions){
            return actions.payment.execute().then(function(){
                window.alert('Đã thanh toán!');
            });
        }
    }, '#paypal-button');
</script> --}}