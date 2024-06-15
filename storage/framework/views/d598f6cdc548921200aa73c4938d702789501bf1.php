
<?php $__env->startSection('content'); ?>
<div class="row container" id="wrapper">
            <div class="halim-panel-filter">
               <div class="panel-heading">
                  <div class="row">
                     <div class="col-xs-7">
                        <div class="yoast_breadcrumb hidden-xs">
                           <span>
                              <span>
                                 <a href="<?php echo e(route('category',$movie->category->slug)); ?>"><?php echo e($movie->category->title); ?></a> » 
                                    <span>
                                       <a href="<?php echo e(route('country',$movie->country->slug)); ?>"><?php echo e($movie->country->title); ?></a> » 

                                       <?php $__currentLoopData = $movie->movie_genre; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <a href="<?php echo e(route('genre',$gen->slug)); ?>"><?php echo e($gen->title); ?></a> »
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

                                       <span class="breadcrumb_last" aria-current="page"><?php echo e($movie->title); ?>

                                       </span>
                                 </span>
                              </span>
                           </span>
                        </div>
                     </div>
                  </div>
               </div>
               <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                  <div class="ajax"></div>
               </div>
            </div>
            <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
               <section id="content" class="test">
                  <div class="clearfix wrap-content">
                    
                     <div class="halim-movie-wrapper">
                        
                        <div class="movie_info col-xs-12">
                           <div class="movie-poster col-md-3">
                              
                              <img class="movie-thumb" src="<?php echo e(asset('uploads/movie/'.$movie->image)); ?>" alt="<?php echo e($movie->title); ?>">
                              
                              
                              <?php if(Auth::check()): ?>
                              <form action="<?php echo e(route('add_bookmark')); ?>" method="POST">
                                 <?php echo csrf_field(); ?>
                                 <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="38424">
                                    <div class="halim-pulse-ring" style="margin-left: 75px"></div>
                                 </div>
                                 <input type="hidden" name="movie_id" value="<?php echo e($movie->id); ?>">
                                 <button class="btn btn-danger" type="submit">Bookmark</button>
                             </form>
                              <?php endif; ?>

                              <!-- Nút bấm Play phim hoặc bấm Xem Trailer -->
                              <?php if($movie->resolution!=5): ?>
                                 <?php if($episode_uploaded_count > 0): ?>
                                    <div class="bwa-content" style="margin-top:-60px">
                                       <div class="loader"></div>
                                       <a href="<?php echo e(url('xem-phim/'.$movie->slug.'/tap-'.$episode_tapdau->episode)); ?>" class="bwac-btn">
                                       <i class="fa fa-play"></i>
                                       </a>
                                    </div>
                                 <?php endif; ?>
                              <?php else: ?>
                                 <button class="btn btn-secondary" style="position: absolute;
                                 top: 50%;
                                 left: 50%;
                                 transform: translate(-50%, -50%);
                                 padding: 10px 20px;
                                 background-color: #f44336;
                                 color: #ffffff;
                                 text-decoration: none;">
                                 <a href="#watch_trailer" class="bwac-btn watch_trailer"><b>Xem Trailer</b>
                                 </a></button>
                              <?php endif; ?>

                           </div>

                           <div class="film-poster col-md-9">
                              <h1 class="movie-title title-1" style="display:block;line-height:35px;margin-bottom: -14px;color: #ffed4d;text-transform: uppercase;font-size: 18px;"><?php echo e($movie->title); ?></h1>
                              <h2 class="movie-title title-2" style="font-size: 12px;"><?php echo e($movie->name_eng); ?></h2>
                              <ul class="list-info-group">
                                 <li class="list-info-group-item"><span>Chất Lượng Phim</span> : <span class="quality">
                                    <?php if($movie->resolution==0): ?>
                                       720p
                                    <?php elseif($movie->resolution==1): ?>
                                       1080p
                                    <?php elseif($movie->resolution==2): ?>
                                       HD+
                                    <?php elseif($movie->resolution==3): ?>
                                       UHD
                                    <?php elseif($movie->resolution==4): ?>
                                       4K
                                    <?php else: ?>
                                       Trailer
                                    <?php endif; ?> 
                                 </span>
                                 
                                 <!--Hiển thị Vietsub /Thuyết Minh-->
                                 <?php if($movie->resolution!=5): ?>
                                 <span class="episode"><i aria-hidden="true"></i>
                                    <?php if($movie->phude==1): ?>
                                       Thuyết Minh
                                    <?php elseif($movie->phude==0): ?>
                                       Vietsub
                                    <?php endif; ?>                              
                                 </span>
                                 <?php endif; ?>
                                 </li>

                                 <?php if($movie->season!=0): ?>
                                    <li class="list-info-group-item"><span>Season</span> : <?php echo e($movie->season); ?></li>
                                 <?php endif; ?>

                                 <li class="list-info-group-item">
                                    <span>Điểm IMDb</span> : <span class="imdb">7.2</span>
                                 </li>

                                 <li class="list-info-group-item">
                                    <span>Thời lượng</span> : <?php echo e($movie->thoi_luong); ?>

                                 </li>

                                 <li class="list-info-group-item">
                                    <span>Danh mục</span> : 
                                    <a href="<?php echo e(route('category',$movie->category->slug)); ?>" rel="category tag"><?php echo e($movie->category->title); ?>

                                    </a>
                                 </li>

                                 <li class="list-info-group-item">
                                    <span>Thể loại</span> : 
                                    <!-- Lấy ra các thể loại của phim này -->
                                    <?php $__currentLoopData = $movie->movie_genre; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <a href="<?php echo e(route('genre',$gen->slug)); ?>" rel="category tag">
                                       <?php echo e($gen->title); ?> - 
                                    </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                    
                                 </li>

                                 <li class="list-info-group-item"><span>Quốc gia</span> : <a href="<?php echo e(route('country',$movie->country->slug)); ?>" rel="tag"><?php echo e($movie->country->title); ?></a></li>

                                 
                                 
                                 <li class="list-info-group-item">
                                    <span>Trạng Thái</span> : 
                                    <?php if($movie->thuocphim=='phimbo'): ?>
                                       <?php echo e($episode_uploaded_count); ?>/<?php echo e($movie->sotap); ?> Tập - 
                                       <?php if($episode_uploaded_count==$movie->sotap): ?>
                                          Hoàn thành
                                       <?php else: ?>
                                          Đang cập nhật
                                       <?php endif; ?>
                                    <?php else: ?>
                                       Phim Lẻ
                                    <?php endif; ?>
                                 </li>

                                 
                                 <li class="list-info-group-item"><span>Danh sách tập phim</span> : 
                                    
                                    <?php if($movie->thuocphim=='phimbo'): ?>
                                       <?php if(isset($episode)): ?>
                                          <?php
                                             // Sắp xếp mảng $episode theo thứ tự tăng dần của episode
                                             $sortedEpisodes = $episode->sortBy('episode');
                                          ?>

                                          <?php $__currentLoopData = $sortedEpisodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <button class="btn btn-primary"><a href="<?php echo e(url('xem-phim/'.$movie->slug.'/tap-'.$ep->episode)); ?>" rel="tag"><?php echo e($ep->episode); ?></a></button>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                       <?php else: ?>
                                          Đang cập nhật
                                       <?php endif; ?>
                                    
                                    <?php elseif($movie->thuocphim=='phimle'): ?>
                                       <?php if(isset($episode_tapdau->episode)): ?>
                                          <button class="btn btn-primary"><a href="<?php echo e(url('xem-phim/'.$movie->slug.'/tap-'.$episode_tapdau->episode)); ?>" rel="tag">Phim Lẻ</a></button>
                                       <?php else: ?>
                                          Đang cập nhật
                                       <?php endif; ?>
                                    <?php endif; ?>
                                 </li>
                                 
                              </ul>
                              
                           
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     
                     <ul class="list-inline rating" title="Rating">
                        <?php for($count=5; $count>=1; $count--): ?>
                           <?php
                              if($count <= $rating){
                                 $color = 'color:#ffcc00;';
                              } else {
                                 $color = 'color:#ccc;';
                              }
                           ?>

                           <li title="star_rating"
                              id="<?php echo e($movie->id); ?>-<?php echo e($count); ?>"
                              data-index = "<?php echo e($count); ?>"
                              data-movie_id = "<?php echo e($movie->id); ?>"
                              data-rating = "<?php echo e($rating); ?>"
                              class = "rating"
                              style = "cursor:pointer; <?php echo e($color); ?> 
                              font-size: 30px;">&#9733;
                           </li>
                        <?php endfor; ?>
                     </ul>
                     <span class="total_rating">Đánh giá: <?php echo e($rating); ?>/<?php echo e($count_total); ?> lượt</span>
                     
                     <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Nội dung phim</span></h2>
                     </div>
                     
                     <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                           <li class="list-info-group-item"><span>Đạo diễn</span> : <a class="director" rel="nofollow" href="https://phimhay.co/dao-dien/cate-shortland" title="Cate Shortland">Cate Shortland</a></li>
                           <li class="list-info-group-item last-item" style="-overflow: hidden;-display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-flex: 1;-webkit-box-orient: vertical;"><span>Diễn viên</span> : <a href="" rel="nofollow" title="C.C. Smiff">C.C. Smiff</a>, <a href="" rel="nofollow" title="David Harbour">David Harbour</a>, <a href="" rel="nofollow" title="Erin Jameson">Erin Jameson</a>, <a href="" rel="nofollow" title="Ever Anderson">Ever Anderson</a>, <a href="" rel="nofollow" title="Florence Pugh">Florence Pugh</a>, <a href="" rel="nofollow" title="Lewis Young">Lewis Young</a>, <a href="" rel="nofollow" title="Liani Samuel">Liani Samuel</a>, <a href="" rel="nofollow" title="Michelle Lee">Michelle Lee</a>, <a href="" rel="nofollow" title="Nanna Blondell">Nanna Blondell</a>, <a href="" rel="nofollow" title="O-T Fagbenle">O-T Fagbenle</a></li>
                           <article id="post-38424" class="item-content">
                              <p><?php echo e($movie->title); ?> &#8211; <?php echo e($movie->name_eng); ?>: <?php echo e($movie->description); ?></p>
                              <h5>Từ Khoá Tìm Kiếm:</h5>
                              
                              <?php if($movie->tags != NULL): ?>
                                 <?php
                                 // Cho các từ khóa vào 1 mảng
                                 $tags = [];
                                 // Tách từng từ khóa ra bằng dấu phẩy
                                 $tags = explode(',',$movie->tags);
                                 ?>

                                 <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(url('tag/'.$tag)); ?>"><?php echo e($tag); ?></a>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php else: ?>
                                 <?php echo e($movie->title); ?>

                              <?php endif; ?>
                           </article>
                        </div>
                     </div>

                     
                     <?php if(isset($movie->trailer)): ?>
                     <div id="halim_trailer">
                        <div class="section-bar clearfix">
                           <h2 class="section-title"><span style="color:#ffed4d">Trailer</span></h2>
                        </div>
                        <div class="entry-content htmlwrap clearfix">
                           <div class="video-item halim-entry-box">
                              <article id="watch_trailer" class="item-content">
                                 <!-- Chiếu Trailer Youtube -->
                                 <iframe width="100%" height="400" style="color: white; font-size: 20px;" src="https://www.youtube.com/embed/<?php echo e($movie->trailer); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

                              </article>
                           </div>
                        </div>
                     </div>
                     <?php endif; ?>

                     <div class="clearfix"></div>                     

                     
                     
                     
                     
                     <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Bình luận</span></h2>
                     </div>
                     <div class="entry-content htmlwrap clearfix">
                        <?php
                           $current_url = Request::url();
                        ?>
                        <div class="video-item halim-entry-box">
                           <article id="post-38424" class="item-content">
                              <div style="font-color: white;" class="fb-comments" data-href="<?php echo e($current_url); ?>" data-width="100%" data-numposts="6"></div>
                           </article>
                        </div>
                     </div>
                  </div>

               </section>

               
               <section class="related-movies">
                  <div id="halim_related_movies-2xx" class="wrap-slider">
                     <div class="section-bar clearfix">
                        <h3 class="section-title"><span>NGƯỜI XEM <?php echo e(strtoupper($movie->title)); ?> CŨNG XEM</span></h3>
                        
                     </div>
                     <div id="halim_related_movies-100" class="owl-carousel owl-theme related-film">
                        <?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $hot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <article class="thumb grid-item post-38498">
                           <div class="halim-item">
                              <a class="halim-thumb" href="<?php echo e(route('movie',$hot->slug)); ?>" title="<?php echo e($hot->title); ?>">
                                 <figure><img class="lazy img-responsive" src="<?php echo e(asset('uploads/movie/'.$hot->image)); ?>" alt="<?php echo e($hot->title); ?>" title="<?php echo e($hot->title); ?>"></figure>
                                 <span class="status">
                                    <?php if($hot->resolution==0): ?>
                                       720p
                                    <?php elseif($hot->resolution==1): ?>
                                       1080p
                                    <?php elseif($hot->resolution==2): ?>
                                       HD+
                                    <?php elseif($hot->resolution==3): ?>
                                       UHD
                                    <?php elseif($hot->resolution==4): ?>
                                       4K
                                    <?php else: ?>
                                       Trailer
                                    <?php endif; ?>   
                                 </span>
                                 
                                 <!--Hiển thị Vietsub /Thuyết Minh-->
                                 <?php if($hot->resolution!=5): ?>
                                 <span class="episode"><i aria-hidden="true"></i>
                                    <?php if($hot->phude==1): ?>
                                       Thuyết Minh
                                    <?php elseif($hot->phude==0): ?>
                                       Vietsub
                                    <?php endif; ?>                              
                                 </span>
                                 <?php endif; ?>

                                 <div class="icon_overlay"></div>
                                 <div class="halim-post-title-box">
                                    <div class="halim-post-title ">
                                       <p class="entry-title"><?php echo e($hot->title); ?></p>
                                       <p class="original_title"><?php echo e($hot->name_eng); ?></p>
                                       <p class="original_title">
                                          <?php if($hot->season!=0): ?>
                                             Season <?php echo e($hot->season); ?>

                                          <?php endif; ?>
                                       </p>
                                    </div>
                                 </div>
                              </a>
                           </div>
                        </article>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </div>

                     
                     <script>
                        $(document).ready(function($) {				
                        var owl = $('#halim_related_movies-100');
                        owl.owlCarousel({
                           loop: true,
                           margin: 4,
                           autoplay: true,
                           autoplayTimeout: 2000,
                           autoplayHoverPause: true,
                           nav: true,
                           navText: [
                              '<i class="fa-solid fa-chevron-left"></i>', 
                              '<i class="fa-solid fa-chevron-right"></i>'],
                           responsiveClass: true,
                           responsive: {
                              0: {items:2},
                              480: {items:3}, 
                              600: {items:4},
                              800: {items:4},
                              1200: {items: 5}}})});
                     </script>
                  </div>
               </section>
               

            </main>
            <!-- Sidebar -->
            <?php echo $__env->make('pages.include.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
         </div>
<script type="text/javascript">
   function remove_background(movie_id){
      for(var count = 1; count <= 5; count ++){
         $('#'+movie_id+'-'+count).css('color','#ccc');
      }
   }
   // Hover chuột đánh giá sao
   $(document).on('mouseenter', '.rating', function(){
      var index = $(this).data("index");
      var movie_id = $(this).data('movie_id');

      remove_background(movie_id);
      for(var count = 1; count <= index; count++){
         $('#'+movie_id+'-'+count).css('color', '#ffcc00');
      }
   });
   // Nhả chuột không đánh giá
   $(document).on('mouseleave', '.rating', function(){
      var index = $(this).data("index");
      var movie_id = $(this).data('movie_id');
      var rating = $(this).data("rating");
      remove_background(movie_id);

      for(var count = 1; count <= rating; count++){
         $('#'+'movie_id'+'-'+count).css('color', '#ffcc00');
      }
   });

   // Click đánh giá sao
   $(document).on('click', '.rating', function(){
      var index = $(this).data("index");
      var movie_id = $(this).data('movie_id');

      $.ajax({
         url: "<?php echo e(route('add-rating')); ?>",
         method: "POST",
         data: {index: index, movie_id: movie_id},
            headers: {
               'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
            },
         success: function(data){
            if(data == 'done'){
               alert("Bạn đã đánh giá " + index + " trên 5 sao. Xin cảm ơn!");
               location.reload();
            } else if (data == 'exist') {
               alert("Bạn đã đánh giá phim này trước đó rồi ạ!");
               location.reload();
            } else {
               alert("Có lỗi xảy ra rồi, bạn vui lòng đánh giá sau nhé!");
               location.reload();
            }
         }
      });
   });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\SoureCode\Laravel\new_4kcinema\resources\views/pages/movie.blade.php ENDPATH**/ ?>