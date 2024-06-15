



<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card"> 
                <div class="card-header">DANH SÁCH TẤT CẢ PHIM <a href="<?php echo e(route('movie.create')); ?>" class="btn btn-primary" style="float:right" >Thêm phim mới</a></div>
            </div>
            
            <?php if(Session::has('success')): ?>
                <div id="movie-index-alert" class="alert alert-success" role="alert">
                    <?php echo e(Session::get('success')); ?>

                </div>
            <?php elseif(Session::has('error')): ?>
                <div id="movie-index-alert" class="alert alert-danger" role="alert">
                    <?php echo e(Session::get('error')); ?>

                </div>
                <script>
                    // Tự động ẩn thông báo sau 3 giây
                    setTimeout(function(){
                    document.getElementById('movie-index-alert').style.display = 'none';
                    }, 4000);
                </script>
            <?php endif; ?>
            <table class="table table-responsive" id="tablePhim">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">English Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Description</th>
                    <th scope="col">Trailer</th>
                    <th scope="col">Season</th>
                    <th scope="col">Tags</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Resolution</th>
                    <th scope="col">Subtitle</th>
                    <th scope="col">Số Tập</th>
                    <th scope="col">Slug</th>
                    <th scope="col">HOT</th>
                    <th scope="col">Top Views</th>
                    <th scope="col">Active/Inactive</th>
                    <th scope="col">Created Date</th>
                    <th scope="col">Updated Date</th>
                    <th scope="col">Release Year</th>
                    <th scope="col">Category</th>
                    <th scope="col">Thuộc phim lẻ hay phim bộ</th>
                    <th scope="col">Genre</th>
                    <th scope="col">Country</th>
                    <th scope="col">Manage</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $mov): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                    
                        <th scope="row"><?php echo e($key+1); ?></th>
                    
                        <td><?php echo e($mov->title); ?></td>
                    
                        <td><?php echo e($mov->name_eng); ?></td>
                    
                        <td><img width="70px" src="<?php echo e(asset('uploads/movie/'.$mov->image)); ?>" alt=""></td>
                    
                        <td>
                            <?php if($mov->description!=NULL): ?>
                                <?php echo e(substr($mov->description,0,10)); ?>...
                            <?php else: ?>
                                Chưa có mô tả phim 
                            <?php endif; ?>
                        </td>
                    
                        <td>
                            <?php if($mov->trailer!=NULL): ?>
                                <?php echo e(substr($mov->trailer,0,20)); ?>...
                            <?php else: ?>
                                Chưa có trailer phim 
                            <?php endif; ?>
                        </td>
                    
                        <td>
                            <?php echo Form::selectRange('season', 0, 20, isset($mov->season) ? $mov->season : '', ['class'=>'select_season', 'id'=>$mov->id]); ?>

                        </td> 
                    
                        <td>
                            <?php if($mov->tags!=NULL): ?>
                                <?php echo e(substr($mov->tags,0,30)); ?>...
                            <?php else: ?>
                                Chưa có tags phim 
                            <?php endif; ?>
                        </td>
                    
                        <td><?php echo e($mov->thoi_luong); ?></td>
                    
                        <td>
                            <?php if($mov->resolution==0): ?>
                                720p
                            <?php elseif($mov->resolution==1): ?>
                                1080p
                            <?php elseif($mov->resolution==2): ?>
                                HD+
                            <?php elseif($mov->resolution==3): ?>
                                UHD
                            <?php elseif($mov->resolution==4): ?>
                                4K
                            <?php else: ?>
                                Trailer
                            <?php endif; ?>
                            
                        </td>
                    
                        <td>
                            <?php echo e($mov->phude ? 'Thuyết Minh' : 'Vietsub'); ?>

                        </td>
                    
                        <td>
                            <?php if($mov->thuocphim=='phimle'): ?>
                                <?php echo e($mov->episode_count); ?><br>
                                <a href="<?php echo e(route('add-episode', [$mov->id])); ?>" class="btn-sm btn btn-info">Thêm/Sửa tập phim </a>
                            <?php else: ?>
                                <?php echo e($mov->episode_count); ?>/<?php echo e($mov->sotap); ?><br><a href="<?php echo e(route('add-episode', [$mov->id])); ?>" class="btn-sm btn btn-info">Thêm/Sửa tập phim </a>                           
                            <?php endif; ?>
                        </td>
                        
                    
                        <td><?php echo e($mov->slug); ?></td>
                    
                        <td>
                            <?php echo e($mov->phim_hot ? 'Có' : 'Không'); ?>

                        </td>
                    
                        <td> 
                            <?php echo Form::select('topview',
                            ['0'=>'Ngày', '1'=>'Tuần', '2'=>'Tháng'],isset($mov->topview) ? $mov->topview : '',
                            ['class'=>'select_topview','id'=>$mov->id]); ?>

                        </td>
                    
                        <td>
                            <?php echo e($mov->status ? 'Hiển thị' : 'Ẩn'); ?>

                        </td>
                    
                        <td><?php echo e($mov->ngay_tao); ?></td>
                    
                        <td><?php echo e($mov->ngay_cap_nhat); ?></td>
                    
                        <td>
                            <?php echo Form::selectYear('year', 1980, 2023, isset($mov->year) ? $mov->year : '', ['class'=>'select_year', 'id'=>$mov->id]); ?>

                        </td>                    
                    
                        
                        <td>
                            <?php echo Form::select('category_id', $category,
                            isset($mov) ? $mov->category->id : '',
                            ['class'=>'category_choose', 'id' => $mov->id]); ?>

                        </td>
                        
                    
                        <td>
                            <?php if($mov->thuocphim=='phimle'): ?>
                                Phim Lẻ
                            <?php else: ?>
                                Phim Bộ
                            
                            <?php endif; ?>
                        </td>
                    
                        <td>
                            <?php $__currentLoopData = $mov->movie_genre; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="badge badge-dark"><?php echo e($gen->title); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                        <!-- Thường khi dùng foreach ta hay thấy có $key để lưu index của các phần tử trong vòng lặp, để ta dễ dàng truy cập lấy các phần tử đó. Còn ở mục thể loại này, ta liệt kê ra hết chứ không có làm gì khác, nên không cần dùng $key  -->

                    
                        
                        <td>
                            <?php echo Form::select('country_id', $country,
                            isset($mov) ? $mov->country->id : '',
                            ['class'=>'country_choose', 'id' => $mov->id]); ?>

                        </td>
                    
                        <td>
                            <?php echo Form::open([
                                'method'=>'DELETE',
                                'route'=>['movie.destroy',$mov->id],
                                'onsubmit'=>'return confirm("Xác nhận xóa?")',
                                'class'=>'d-inline-block'
                            ]); ?>

                            <?php echo Form::submit('Xóa', ['class'=>'btn btn-danger']); ?>

                            <?php echo Form::close(); ?>

                            <a href="<?php echo e(route('movie.edit', $mov->id)); ?>" class="btn btn-warning d-inline-block">Sửa</a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\SoureCode\Laravel\new_4kcinema\resources\views/admincp/movie/index.blade.php ENDPATH**/ ?>