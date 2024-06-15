



<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><?php echo e($movie->title); ?></div>                
            </div>
            
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
                <div class="card card-responsive">    
                    <div class="card-body">
                        <?php if(session('status')): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo e(session('status')); ?>

                            </div>
                        <?php endif; ?>
                        <!--Lưu ý bên dưới là form của Laravel Collective: giúp rút gọn code-->
                        <?php if(!isset($episode)): ?>
                            <?php echo Form::open(['route'=>'episode.store', 'method'=>'POST', 'enctype'=>'multipart/form-data', 'files' => true]); ?>

                        <?php else: ?>
                            <?php echo Form::open(['route'=>['episode.update', $episode->id], 'method'=>'PUT', 'enctype'=>'multipart/form-data', 'files' => true]); ?> 
                        <?php endif; ?>

                        
                            <div class=form-group>
                                <?php echo Form::label('movie_title', 'Tên Phim', []); ?>

                                <?php echo Form::text('movie_title', isset($movie) ? $movie->title : '',
                                    ['class'=>'form-control', 'readonly']); ?>

                                <?php echo Form::hidden('movie_id', isset($movie) ? $movie->id : ''); ?>

                            </div>
                          
                                
                        <!--Video Phim tải lên từ máy tính-->
                            <div class=form-group>
                                <?php echo Form::label('linkphim720', 'Video Phim Chất Lượng 720p', []); ?>

                                <?php echo Form::file('linkphim720', ['class'=>'form-control', 'placeholder'=>'Chọn video 720p từ máy tính']); ?>

                            </div>
                            <div class=form-group>
                                <?php echo Form::label('linkphim4K', 'Video Phim Chất Lượng 4K', []); ?>

                                <?php echo Form::file('linkphim4K', ['class'=>'form-control', 'placeholder'=>'Chọn video 4K từ máy tính']); ?>

                            </div>
                        <!--Tập Phim / khi cập nhật thì không được sửa tập phim-->
                            <?php if(isset($episode)): ?>
                                <div class=form-group>
                                    <?php echo Form::label('episode', 'Tập Phim', []); ?>

                                    <?php echo Form::text('episode', isset($episode) ? $episode->episode : '',
                                        ['class'=>'form-control', isset($episode) ? 'readonly' : '']); ?>

                                </div>                                
                            <?php else: ?>
                                <div class=form-group>
                                    <?php echo Form::label('episode', 'Tập Phim', []); ?>

                                    <?php echo Form::selectRange('episode', 1, $movie->sotap, $movie->sotap, ['class'=>'form-control']); ?>

                                </div>                                 
                            <?php endif; ?>
                        <!--Submit-->
                            <?php if(!isset($episode)): ?>
                                <?php echo Form::submit('Thêm tập phim mới', ['class'=>'btn btn-info']); ?>

                            <?php else: ?>
                                <?php echo Form::submit('Cập nhật', ['class'=>'btn btn-warning']); ?>

                            <?php endif; ?>
                        <?php echo Form::close(); ?>

                    </div>
                </div>

            
            <table class="table" id="tablePhim">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên phim</th>
                    <th scope="col">Poster phim</th>
                    <th scope="col">Tập phim</th>
                    <th scope="col">Linkphim720</th>
                    <th scope="col">Linkphim4K</th>
                     
                    <th scope="col">Quản lý</th>
                  </tr>
                </thead>
                
                <tbody class="order_position"> 
                    <?php $__currentLoopData = $list_episode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    <tr id="<?php echo e($ep->movie->id); ?>">
                        <th scope="row"><?php echo e($key+1); ?></th>
                        <td><?php echo e($ep->movie->title); ?></td>
                        <td><img width="90px" height="150px" src="<?php echo e(asset('uploads/movie/'.$ep->movie->image)); ?>" alt=""></td>
                        <td><?php echo e($ep->episode); ?></td>
                        
                        
                        <td><?php echo e($ep->linkphim720); ?></td>
                        <td><?php echo e($ep->linkphim4K); ?></td>
                        
                        <td>
                            <?php echo Form::open([
                                'method'=>'DELETE',
                                'route'=>['episode.destroy',$ep->id],
                                'onsubmit'=>'return confirm("Xác nhận xóa?")',
                                'class'=>'d-inline-block'
                            ]); ?>

                            <?php echo Form::submit('Xóa', ['class'=>'btn btn-danger']); ?>

                            <?php echo Form::close(); ?>

                            <a href="<?php echo e(route('episode.edit', $ep->id)); ?>" class="btn btn-warning d-inline-block">Sửa</a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\SoureCode\Laravel\new_4kcinema\resources\views/admincp/episode/add_episode.blade.php ENDPATH**/ ?>