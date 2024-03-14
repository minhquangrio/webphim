<?php
//QUẢN LÝ CÁC CHỨC NĂNG Ở TRANG ADMIN THỂ LOẠI
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = Genre::all(); //lấy tất cả dữ liệu ra
        return view('admincp.genre.form', compact('list')); //thực hiện gửi list danh sách vào genre form
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $genre = new Genre();
        $genre->title = $data['title'];
        $genre->description = $data['description'];
        $genre->status = $data['status'];
        $genre->slug = $data['slug'];
        $genre->save();
        return redirect()->back(); //quay trở về trang trước đó
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
        $genre = Genre::find($id);
        $list = Genre::all(); //lấy tất cả dữ liệu ra
        if (!$genre) {
            abort(404);
        }
        return view('admincp.genre.form', compact('list', 'genre')); //thực hiện gửi list danh sách vào genre form
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $genre = Genre::find($id);
        $genre->title = $data['title'];
        $genre->description = $data['description'];
        $genre->status = $data['status'];
        $genre->slug = $data['slug'];
        $genre->save();
        return redirect()->back(); //quay trở về trang trước đó
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Genre::find($id)->delete();
        return redirect()->back(); //quay trở về trang trước đó
    }
}