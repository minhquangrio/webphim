


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo e(route('category.create')); ?>">DANH MỤC PHIM</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo e(route('genre.create')); ?>">THỂ LOẠI</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo e(route('country.create')); ?>">QUỐC GIA</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo e(route('movie.index')); ?>">PHIM</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo e(route('manageUser.create')); ?>">NGƯỜI DÙNG</a>
        </li>
        <li class="nav-item active">
          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Ngôn ngữ
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="<?php echo e(url('lang.vi')); ?>">Vietnamese</a>
              <a class="dropdown-item" href="<?php echo e(url('lang.en')); ?>">English</a>
            </div>
          </div>
        </li>
      </ul>
      
    </div>
  </nav>

<?php /**PATH D:\SoureCode\Laravel\new_4kcinema\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>