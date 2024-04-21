{{-- TRANG ADMIN NÀY LÀ FORM ĐỂ THÊM MỘT DANH MỤC MỚI --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{$movie->title}}</div>                
            </div>
            {{-- In ra thông báo --}}
            @if(Session::has('success'))
                <div id="login-alert" class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
            @elseif(Session::has('error'))
                <div id="login-alert" class="alert alert-danger" role="alert">
                    {{Session::get('error')}}
                </div>
                <script>
                    // Tự động ẩn thông báo sau 3 giây
                    setTimeout(function(){
                    document.getElementById('login-alert').style.display = 'none';
                    }, 4000);
                </script>
            @endif
                <div class="card card-responsive">    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <!--Lưu ý bên dưới là form của Laravel Collective: giúp rút gọn code-->
                        @if(!isset($episode))
                            {!! Form::open(['route'=>'episode.store', 'method'=>'POST', 'enctype'=>'multipart/form-data', 'files' => true]) !!}
                        @else
                            {!! Form::open(['route'=>['episode.update', $episode->id], 'method'=>'PUT', 'enctype'=>'multipart/form-data', 'files' => true]) !!} 
                        @endif

                        {{-- Tên phim --}}
                            <div class=form-group>
                                {!! Form::label('movie_title', 'Tên Phim', []) !!}
                                {!! Form::text('movie_title', isset($movie) ? $movie->title : '',
                                    ['class'=>'form-control', 'readonly']) !!}
                                {!! Form::hidden('movie_id', isset($movie) ? $movie->id : '') !!}
                            </div>
                        {{-- Chất lượng phim --}}  
                                {{-- {!! Form::label('quality', 'Chất Lượng Tập Phim', []) !!} 
                                <br>

                                {!! Form::radio('quality', '4K', isset($episode) && $episode->quality == '4K', ['class' => 'form-check-input']) !!}
                                {!! Form::label('quality_4K', '4K', ['class' => 'form-check-label', 'style' => 'margin-right: 50px; margin-left: 20px']) !!}

                                {!! Form::radio('quality', '720', isset($episode) && $episode->quality == '720', ['class' => 'form-check-input']) !!}
                                {!! Form::label('quality_720', '720', ['class' => 'form-check-label', 'style' => 'margin-right: 50px; margin-left: 20px']) !!} --}}
                        <!--Video Phim tải lên từ máy tính-->
                            <div class=form-group>
                                {!! Form::label('linkphim720', 'Video Phim Chất Lượng 720p', []) !!}
                                {!! Form::file('linkphim720', ['class'=>'form-control', 'placeholder'=>'Chọn video 720p từ máy tính']) !!}
                            </div>
                            <div class=form-group>
                                {!! Form::label('linkphim4K', 'Video Phim Chất Lượng 4K', []) !!}
                                {!! Form::file('linkphim4K', ['class'=>'form-control', 'placeholder'=>'Chọn video 4K từ máy tính']) !!}
                            </div>
                        <!--Tập Phim / khi cập nhật thì không được sửa tập phim-->
                            @if(isset($episode))
                                <div class=form-group>
                                    {!! Form::label('episode', 'Tập Phim', []) !!}
                                    {!! Form::text('episode', isset($episode) ? $episode->episode : '',
                                        ['class'=>'form-control', isset($episode) ? 'readonly' : '']) !!}
                                </div>                                
                            @else
                                <div class=form-group>
                                    {!! Form::label('episode', 'Tập Phim', []) !!}
                                    {!! Form::selectRange('episode', 1, $movie->sotap, $movie->sotap, ['class'=>'form-control']) !!}
                                </div>                                 
                            @endif
                        <!--Submit-->
                            @if(!isset($episode))
                                {!! Form::submit('Thêm tập phim mới', ['class'=>'btn btn-info']) !!}
                            @else
                                {!! Form::submit('Cập nhật', ['class'=>'btn btn-warning']) !!}
                            @endif
                        {!! Form::close() !!}
                    </div>
                </div>

            {{-- LIỆT KÊ DANH SÁCH CÁC TẬP PHIM --}}
            <table class="table" id="tablePhim">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên phim</th>
                    <th scope="col">Poster phim</th>
                    <th scope="col">Tập phim</th>
                    <th scope="col">Linkphim720</th>
                    <th scope="col">Linkphim4K</th>
                    {{-- <th scope="col">Active/Inactive</th> --}} 
                    <th scope="col">Quản lý</th>
                  </tr>
                </thead>
                {{-- đặt class: order-position để drag các danh mục bằng sortable --}}
                <tbody class="order_position"> 
                    @foreach($list_episode as $key => $ep)
                    {{-- trong thẻ tr lấy id của danh mục ra để drag --}}
                    <tr id="{{$ep->movie->id}}">
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$ep->movie->title}}</td>
                        <td><img width="90px" height="150px" src="{{asset('uploads/movie/'.$ep->movie->image)}}" alt=""></td>
                        <td>{{$ep->episode}}</td>
                        {{-- Lưu ý trong laravel, các thành phần có chứa html cần được đặt trong dấu {!! !!} --}}
                        {{-- còn nếu muốn hiển thị link phim kiểu text thôi thì gõ như bên dưới, web đỡ load video --}}
                        <td>{{$ep->linkphim720}}</td>
                        <td>{{$ep->linkphim4K}}</td>
                        {{-- <td>
                            {{ $ep->status ? 'Hiển thị' : 'Ẩn' }}
                        </td> --}}
                        <td>
                            {!! Form::open([
                                'method'=>'DELETE',
                                'route'=>['episode.destroy',$ep->id],
                                'onsubmit'=>'return confirm("Xác nhận xóa?")',
                                'class'=>'d-inline-block'
                            ]) !!}
                            {!! Form::submit('Xóa', ['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            <a href="{{route('episode.edit', $ep->id)}}" class="btn btn-warning d-inline-block">Sửa</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>
@endsection