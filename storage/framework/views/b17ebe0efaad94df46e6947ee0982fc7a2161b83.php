<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

<!--Table-->
<div id="app">
    <span><a href="<?php echo e(URL::to('/')); ?>">QUAY LẠI TRANG CHỦ</a></span>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
        <h3>Bookmark List</h3>
        
        <?php if(Session::has('success')): ?>
            <div id="bookmark-alert" class="alert alert-success" role="alert">
                <?php echo e(Session::get('success')); ?>

            </div>
        <?php elseif(Session::has('error')): ?>
            <div id="bookmark-alert" class="alert alert-danger" role="alert">
                <?php echo e(Session::get('error')); ?>

            </div>
            <script>
                // Tự động ẩn thông báo sau 2 giây
                setTimeout(function(){
                document.getElementById('bookmark-alert').style.display = 'none';
                }, 2000);
            </script>
        <?php endif; ?>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="container">
                <table class="table table-striped w-auto">
                    <?php if($bookmarkedMovies->isEmpty()): ?>
                        <p>No bookmarked movies.</p>
                    <?php else: ?>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên Phim</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $bookmarkedMovies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bm_movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="table-info">
                        <th scope="row"><?php echo e($key+1); ?></th>
                        <td>
                            <a href="<?php echo e(route('movie',$bm_movie->slug)); ?>">
                                <?php echo e($bm_movie->title); ?>

                            </a>
                        </td>
                        <td>
                            <form action="<?php echo e(route('delete_bookmark', $bm_movie->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <?php endif; ?>
                </table>  
            </div>            
        </div>
    </nav>
</div><?php /**PATH D:\SoureCode\Laravel\new_4kcinema\resources\views/pages/bookmark.blade.php ENDPATH**/ ?>