



<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-14">
            <div class="card">
                <div class="card-header">QUẢN LÝ THỂ LOẠI</div>
                <a href="<?php echo e(route('genre.create')); ?>" class="btn btn-primary">Thêm thể loại</a>
                <div class="card-body">
                    
                    <?php if(Session::has('success')): ?>
                        <div id="login-alert" class="alert alert-success" role="alert">
                            <?php echo e(Session::get('success')); ?>

                        </div>
                    <?php elseif(Session::has('error')): ?>
                        <div id="login-alert" class="alert alert-danger" role="alert">
                            <?php echo e(Session::get('error')); ?>

                        </div>
                        <script>
                            // Tự động ẩn thông báo sau 3 giây
                            setTimeout(function(){
                            document.getElementById('login-alert').style.display = 'none';
                            }, 4000);
                        </script>
                    <?php endif; ?>
                    <!--Lưu ý bên dưới là form của Laravel Collective: giúp rút gọn code-->
                    <?php if(!isset($genre)): ?>
                        <?php echo Form::open(['route'=>'genre.store', 'method'=>'POST']); ?>

                    <?php else: ?>
                        <?php echo Form::open(['route'=>['genre.update', $genre->id], 'method'=>'PUT']); ?> 
                    <?php endif; ?>
                        <div class=form-group>
                            <?php echo Form::label('title', 'Title', []); ?>

                            <?php echo Form::text(
                                'title', 
                                isset($genre) ? $genre->title : '',
                                ['class'=>'form-control', 'placeholder'=>'Nhập dữ liệu',
                                'id'=>'slug', 'onkeyup'=>'ChangeToSlug()']); ?>

                        </div>
                        <div class=form-group>
                            <?php echo Form::label('slug', 'Slug', []); ?>

                            <?php echo Form::text(
                                'slug', 
                                isset($genre) ? $genre->slug : '',
                                ['class'=>'form-control', 'placeholder'=>'Nhập dữ liệu',
                                'id'=>'convert_slug']); ?>

                        </div>
                        <div class=form-group>
                            <?php echo Form::label('description', 'Description', []); ?>

                            <?php echo Form::textarea(
                            'description',
                            isset($genre) ? $genre->description : '',
                            ['style'=>'resize:none','class'=>'form-control',
                            'placeholder'=>'Nhập dữ liệu',
                            'id'=>'description']); ?>

                        </div>
                        <div class=form-group>
                            <?php echo Form::label('active', 'Active', []); ?>

                            <?php echo Form::select('status',
                            ['1'=>'Hiển thị', '0'=>'Ẩn'],isset($genre) ? $genre->status : 'Hiển thị',
                            ['class'=>'form-control']); ?>

                        </div>

                        <?php if(!isset($genre)): ?>
                            <?php echo Form::submit('Thêm dữ liệu', ['class'=>'btn btn-info']); ?>

                        <?php else: ?>
                            <?php echo Form::submit('Cập nhật', ['class'=>'btn btn-info']); ?>

                        <?php endif; ?>
                    <?php echo Form::close(); ?>

                </div>
            </div>
            <table class="table" id="tablePhim">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Active/Inactive</th>
                    <th scope="col">Manage</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <th scope="row"><?php echo e($key+1); ?></th>
                        <td><?php echo e($cate->title); ?></td>
                        <td><?php echo e($cate->description); ?></td>
                        <td><?php echo e($cate->slug); ?></td>
                        <td>
                            <?php echo e($cate->status ? 'Hiển thị' : 'Ẩn'); ?>

                        </td>
                        <td>
                            <?php echo Form::open([
                                'method'=>'DELETE',
                                'route'=>['genre.destroy',$cate->id],
                                'onsubmit'=>'return confirm("Xác nhận xóa?")',
                                'class'=>'d-inline-block'
                            ]); ?>

                            <?php echo Form::submit('Xóa', ['class'=>'btn btn-danger']); ?>

                            <?php echo Form::close(); ?>

                            <a href="<?php echo e(route('genre.edit', $cate->id)); ?>" class="btn btn-warning d-inline-block">Sửa</a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\SoureCode\Laravel\new_4kcinema\resources\views/admincp/genre/form.blade.php ENDPATH**/ ?>