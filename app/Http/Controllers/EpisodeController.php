<?php
//QUẢN LÝ CÁC CHỨC NĂNG Ở TRANG ADMIN TẬP PHIM
namespace App\Http\Controllers;

use App\Models\Video;
use Carbon\Carbon; //quản lý thời gian/thứ/ngày/tháng
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Episode;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_episode = Episode::with('movie')->orderBy('movie_id', 'DESC')->get(); //pluck chỉ lấy ra title và id của phim thôi
        return view('admincp.episode.index', compact('list_episode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_movie = Movie::orderBy('id', 'DESC')->pluck('title', 'id', 'sotap'); //pluck chỉ lấy ra title và id của phim thôi
        return view('admincp.episode.form', compact('list_movie'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    //Hàm này sau này hãy tự làm lại bằng ajax để không cần reload page
    {
        $data = $request->all();
        $episode_check_exist = Episode::where('episode', $data['episode'])->where('movie_id', $data['movie_id'])->count();
        if ($episode_check_exist) {
            return redirect()->back()->with('error', 'Tập này đã thêm video rồi!');
        } else {
            $episode = new Episode();
            $episode->movie_id = $data['movie_id']; //cột "movie_id" trong DB nhận giá trị của phần tử có name "movie_id" trong html
            $episode->episode = $data['episode'];
            // Lưu trữ tệp tin video vào thư mục trên máy chủ
            if ($request->hasFile('linkphim720')) {
                $file = $request->file('linkphim720');
                // Tạo tên file video 720 theo format
                $slug = Movie::where('id', $episode->movie_id)->value('slug'); // Lấy slug từ tên phim
                $fileName = $slug . '_' . $episode->episode . '_' . '720' . '.mp4';

                $file->move(public_path('uploads/video'), $fileName); // Di chuyển tệp tin vào thư mục lưu trữ của bạn
                $episode->linkphim720 = 'uploads/video/' . $fileName; // Lưu đường dẫn tới tệp tin vào cơ sở dữ liệu
            }
            if ($request->hasFile('linkphim4K')) {
                $file = $request->file('linkphim4K');
                // Tạo tên file video 4K theo format
                $slug = Movie::where('id', $episode->movie_id)->value('slug'); // Lấy slug từ tên phim
                $fileName = $slug . '_' . $episode->episode . '_' . '4K' . '.mp4';

                $file->move(public_path('uploads/video'), $fileName); // Di chuyển tệp tin vào thư mục lưu trữ của bạn
                $episode->linkphim4K = 'uploads/video/' . $fileName; // Lưu đường dẫn tới tệp tin vào cơ sở dữ liệu
            }

            $episode->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            $episode->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $episode->save();
        }

    }
    public function add_episode($id)
    {
        $movie = Movie::find($id);
        $list_episode = Episode::with('movie')->where('movie_id', $id)->orderBy('id', 'DESC')->get();
        return view('admincp.episode.add_episode', compact('list_episode', 'movie'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $episode = Episode::find($id);
        $list_movie = Movie::orderBy('id', 'DESC')->pluck('title', 'id', 'sotap'); //lấy ra danh sách phim để đối chiếu
        return view('admincp.episode.form', compact('episode', 'list_movie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    //hàm này sau này nhớ tự làm lại bằng ajax để không cần reload page nhé
    {
        $data = $request->all();
        $episode = Episode::find($id);
        $episode->movie_id = $data['movie_id']; //cột "movie_id" trong DB nhận giá trị của phần tử có name "movie_id" trong html
        $episode->episode = $data['episode'];
        if ($request->hasFile('linkphim720')) {
            $file = $request->file('linkphim720');
            // Tạo tên file video 720 theo format
            $slug = Movie::where('id', $episode->movie_id)->value('slug'); // Lấy slug từ tên phim
            $fileName1 = $slug . '_' . $episode->episode . '_' . '720' . '.mp4';

            $file->move(public_path('uploads/video'), $fileName1); // Di chuyển tệp tin vào thư mục lưu trữ của bạn
            $episode->linkphim720 = 'uploads/video/' . $fileName1; // Lưu đường dẫn tới tệp tin vào cơ sở dữ liệu
        }
        if ($request->hasFile('linkphim4K')) {
            $file = $request->file('linkphim4K');
            // Tạo tên file video 4K theo format
            $slug = Movie::where('id', $episode->movie_id)->value('slug'); // Lấy slug từ tên phim
            $fileName2 = $slug . '_' . $episode->episode . '_' . '4K' . '.mp4';

            $file->move(public_path('uploads/video'), $fileName2); // Di chuyển tệp tin vào thư mục lưu trữ của bạn
            $episode->linkphim4K = 'uploads/video/' . $fileName2; // Lưu đường dẫn tới tệp tin vào cơ sở dữ liệu
        }
        $episode->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $episode->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $episode->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $episode = Episode::find($id)->delete();
        return redirect()->back();
    }

    public function select_movie()
    {
        $id = $_GET['id'];
        $movie = Movie::find($id);
        $output = '';
        if ($movie->thuocphim == 'phimbo') {
            for ($i = 1; $i <= $movie->sotap; $i++) {
                $output .= '<option value="' . $i . '">' . $i . '</option>'; // .= nghĩa là nối chuỗi
            }
        } else {
            $output = '<option value="phimle">Phim Lẻ</option>';
        }

        echo $output;
    }

}