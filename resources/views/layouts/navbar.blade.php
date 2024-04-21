{{-- CÁC MENU HIỂN THỊ Ở TRANG ADMIN --}}


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{route('dashboard')}}">Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="{{route('category.create')}}">DANH MỤC PHIM</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="{{route('genre.create')}}">THỂ LOẠI</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="{{route('country.create')}}">QUỐC GIA</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="{{route('movie.index')}}">PHIM</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="{{route('manageUser.create')}}">NGƯỜI DÙNG</a>
        </li>
        <li class="nav-item active">
          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Ngôn ngữ
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="{{url('lang.vi')}}">Vietnamese</a>
              <a class="dropdown-item" href="{{url('lang.en')}}">English</a>
            </div>
          </div>
        </li>
      </ul>
      {{-- <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm phim" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm kiếm</button>
      </form> --}}
    </div>
  </nav>

