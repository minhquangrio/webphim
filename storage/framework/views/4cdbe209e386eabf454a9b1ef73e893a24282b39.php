



<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-14">
            <div class="card">
                <a href="<?php echo e(route('movie.index')); ?>" class="btn btn-primary">Hiển thị tất cả phim</a>
                <div class="card-header">QUẢN LÝ CHI TIẾT PHIM</div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                    <!--Lưu ý bên dưới là form của Laravel Collective: giúp rút gọn code-->
                    <?php if(!isset($movie)): ?>
                        <?php echo Form::open(['route'=>'movie.store', 'method'=>'POST', 'enctype'=>'multipart/form-data']); ?>

                    <?php else: ?>
                        <?php echo Form::open(['route'=>['movie.update', $movie->id], 'method'=>'PUT', 'enctype'=>'multipart/form-data']); ?> 
                    <?php endif; ?>
                    <!--Nhập tên phim-->
                        <div class=form-group>
                            <?php echo Form::label('title', 'Title', []); ?>

                            <?php echo Form::text(
                                'title', 
                                isset($movie) ? $movie->title : '',
                                ['class'=>'form-control', 'placeholder'=>'Nhập dữ liệu',
                                'id'=>'slug', 'onkeyup'=>'ChangeToSlug()']); ?>

                        </div>
                    <!--Nhập tên tiếng Anh của phim-->
                        <div class=form-group>
                            <?php echo Form::label('engName', 'English Name', []); ?>

                            <?php echo Form::text(
                                'name_eng', 
                                isset($movie) ? $movie->name_eng : '',
                                ['class'=>'form-control', 'placeholder'=>'Nhập dữ liệu']); ?>

                        </div>
                    <!--Slug của phim được tự động tạo ra hoặc tự nhập-->
                        <div class=form-group>
                            <?php echo Form::label('slug', 'Slug', []); ?>

                            <?php echo Form::text(
                                'slug', 
                                isset($movie) ? $movie->slug : '',
                                ['class'=>'form-control', 'placeholder'=>'Nhập dữ liệu',
                                'id'=>'convert_slug']); ?>

                        </div>
                    <!--Season phim--> 
                        <div class=form-group>
                            <?php echo Form::label('season', 'Season', []); ?>

                            <?php echo Form::selectRange('season', 0, 20, isset($movie) ? $movie->season : '', ['class'=>'select_season']); ?>

                        </div>
                    <!--Nhập mô tả phim-->
                        <div class=form-group>
                            <?php echo Form::label('description', 'Description', []); ?>

                            <?php echo Form::textarea(
                            'description',
                            isset($movie) ? $movie->description : '',
                            ['style'=>'resize:none','class'=>'form-control',
                            'placeholder'=>'Nhập dữ liệu',
                            'id'=>'description']); ?>

                        </div>
                    <!--Nhập video trailer phim-->
                        <div class=form-group>
                            <?php echo Form::label('trailer', 'Trailer', []); ?>

                            <?php echo Form::text(
                                'trailer', 
                                isset($movie) ? $movie->trailer : '',
                                ['class'=>'form-control', 'placeholder'=>'Nhập dữ liệu']); ?>

                        </div>
                    <!--Nhập từ khóa tags phim-->
                        <div class=form-group>
                            <?php echo Form::label('tags', 'Tags', []); ?>

                            <?php echo Form::textarea(
                            'tags',
                            isset($movie) ? $movie->tags : '',
                            ['style'=>'resize:none','class'=>'form-control',
                            'placeholder'=>'Nhập từ khóa phim',
                            'id'=>'tags']); ?>

                        </div>
                    <!--Nhập thời lượng phim-->
                        <div class=form-group>
                            <?php echo Form::label('thoi_luong', 'Duration', []); ?>

                            <?php echo Form::text(
                                'thoi_luong', 
                                isset($movie) ? $movie->thoi_luong : '',
                                ['class'=>'form-control', 'placeholder'=>'Nhập thời lượng phim']); ?>

                        </div>
                    <!--Chọn chất lượng phim-->
                        <div class=form-group>
                            <?php echo Form::label('resolution', 'Resolution', []); ?>

                            <?php echo Form::select('resolution',
                            ['0'=>'720p', '1'=>'1080p', '2'=>'HD+', '3'=>'UHD', '4'=>'4K', '5'=>'Trailer'],isset($movie) ? $movie->resolution : '720p',
                            ['class'=>'form-control']); ?>

                        </div>
                    <!--Chọn Thuyết Minh hay Phụ Đề-->
                        <div class=form-group>
                            <?php echo Form::label('phude', 'Voiceover - Subtitle', []); ?>

                            <?php echo Form::select('phude',
                            ['1'=>'Thuyết Minh', '0'=>'Vietsub'],isset($movie) ? $movie->phude : 'Đang cập nhật',
                            ['class'=>'form-control']); ?>

                        </div>
                    <!--Số Tập của Phim-->
                        <div class=form-group>
                            <?php echo Form::label('sotap', 'Số Tập Phim', []); ?>

                            <?php echo Form::select('sotap', range(0, 1000), isset($movie) ? $movie->sotap : '', ['class'=>'select_year']); ?>

                        </div>
                    <!--Chọn trạng thái (1): hiển thị hoặc (0): ẩn-->
                        <div class=form-group>
                            <?php echo Form::label('active', 'Active', []); ?>

                            <?php echo Form::select('status',
                            ['1'=>'Hiển thị', '0'=>'Ẩn'],isset($movie) ? $movie->status : 'Hiển thị',
                            ['class'=>'form-control']); ?>

                        </div>
                    <!-- Năm phát hành phim -->
                        <div class=form-group>
                            <?php echo Form::label('year', 'Release Year', []); ?>

                            <?php echo Form::selectYear('year', 1980, 2023, isset($movie) ? $movie->year : '', ['class'=>'select_year']); ?>

                        </div> 
                    <!--Phim thuộc danh mục nào?-->
                        <div class=form-group>
                            <?php echo Form::label('category', 'Category', []); ?>

                            <?php echo Form::select('category_id', $category,
                            isset($movie) ? $movie->category_id : '',
                            ['class'=>'form-control']); ?>

                        </div>
                    <!--Thuộc phim lẻ hay phim bộ, mục đích để hiển thị tập phim hoặc không-->
                    <div class=form-group>
                        <?php echo Form::label('thuocphim', 'Thuộc phim lẻ hay bộ?', []); ?>

                        <?php echo Form::select('thuocphim', ['phimle'=>'Phim Lẻ', 'phimbo'=>'Phim Bộ'], isset($movie) ? $movie->thuocphim : '',
                            ['class'=>'form-control']); ?>

                    </div>
                    <!--Phim thuộc quốc gia nào?-->
                        <div class=form-group>
                            <?php echo Form::label('country', 'Country', []); ?>

                            <?php echo Form::select('country_id', $country,
                            isset($movie) ? $movie->country_id : '',
                            ['class'=>'form-control']); ?>

                        </div>
                    <!--Phim thuộc thể loại nào?-->
                        <div class=form-group>
                            <?php echo Form::label('genre', 'Genre', []); ?>

                            <br>
                            
                            
                            <?php $__currentLoopData = $list_genre; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $gen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(isset($movie)): ?>
                                <?php echo Form::checkbox('genre[]', $gen->id, isset($movie_genre) && $movie_genre->contains($gen->id) ? true : false ); ?>

                                <!-- Nếu phim này có tồn tại trong bảng movie_genre (isset(movie_genre)), tức là thuộc nhiều thể loại (contains nhiều genre_id, mà do đã khai báo khóa ngoại, nên trong laravel tự động hiểu là id), thì checked các thể loại đó trong checkbox -->
                            <?php else: ?>
                                <?php echo Form::checkbox('genre[]', $gen->id, ''); ?>

                            <?php endif; ?>
                            <?php echo Form::label('genre', $gen->title); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>
                    <!--Phim HOT hiển thị đầu trang hay không?-->
                        <div class=form-group>
                            <?php echo Form::label('hot', 'Hot', []); ?>

                            <?php echo Form::select('phim_hot', ['1'=>'Có', '0'=>'Không'],isset($movie) ? $movie->phim_hot : '',
                            ['class'=>'form-control']); ?>

                        </div>
                    <!--Ảnh của phim-->
                        <div class=form-group>                            

                            <?php if(isset($movie)): ?>
                                <span>Poster phim hiện tại</span><br>
                                <img width="80px" src="<?php echo e(asset('uploads/movie/'.$movie->image)); ?>" alt=""><br>
                                <span>Bạn có muốn đổi poster khác không?</span><br>
                                <input type="file" name="image" onchange="previewFile(this)" required class="form-control image-preview">
                                <img id="previewImg" width="80px" src=""><br>
                            <?php else: ?>
                                <?php echo Form::label('image', 'Image', []); ?>

                                <input type="file" name="image" onchange="previewFile(this)" required class="form-control image-preview">
                                <img id="previewImg" width="80px" src=""><br>
                            <?php endif; ?>
                        </div>
                        
                        <script type="text/javascript">
                            function previewFile(input){
                                var file = $(".image-preview").get(0).files[0];
                                if(file){
                                    var reader = new FileReader();
                                    reader.onload = function(){
                                        $("#previewImg").attr("src", reader.result);
                                    }
                                    reader.readAsDataURL(file);
                                }
                            }
                        </script>
                    <!--Submit-->
                        <?php if(!isset($movie)): ?>
                            <?php echo Form::submit('Thêm dữ liệu', ['class'=>'btn btn-info']); ?>

                        <?php else: ?>
                            <?php echo Form::submit('Cập nhật', ['class'=>'btn btn-warning']); ?>

                        <?php endif; ?>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\SoureCode\Laravel\new_4kcinema\resources\views/admincp/movie/form.blade.php ENDPATH**/ ?>