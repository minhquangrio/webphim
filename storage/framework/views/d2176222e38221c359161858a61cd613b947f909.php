
<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="https://cdn.plyr.io/3.7.2/plyr.css">
<div class="row container" id="wrapper">
         <div class="halim-panel-filter">
            <div class="panel-heading">
               <div class="row">
                  <div class="col-xs-9">
                     <div class="yoast_breadcrumb hidden-xs"><span><span><span>Bạn đang xem phim » </span><span><a href="<?php echo e(route('country', [$movie->country->slug])); ?>"><?php echo e($movie->country->title); ?></a> » <span class="breadcrumb_last" aria-current="page"><a href=""><?php echo e($movie->title); ?></a></span></span></span></span></div>
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

                  
                  <div >


                     <?php if(Auth::check() && $user->isVip == 1): ?>
                        <video id="videoPlayer" controls style="width: 810px; height: 500px">
                           <source id="videoSource" src="<?php echo e(asset($episode->linkphim4K)); ?>" type="video/mp4">
                        </video>
                        
                        <button onclick="seekVideo(-10)" class="btn btn-lg"><i class="fa-regular fa-square-caret-left"></i></button>
                        <button onclick="seekVideo(10)" class="btn btn-lg"><i class="fa-regular fa-square-caret-right"></i></button>
                        
                        <div>
                           <button onclick="changeVideoQuality720()">Chất lượng 720p</button>
                           <button onclick="changeVideoQuality4K()">Chất lượng 4K</button>
                        </div>
                        <span>VIP: Bạn đang xem phim chất lượng tối đa 4K</span>
                     <?php else: ?>
                        <video id="videoPlayer" controls style="width: 810px; height: 500px">
                           <source id="videoSource" src="<?php echo e(asset($episode->linkphim720)); ?>" type="video/mp4">
                        </video>
                        
                        <button onclick="seekVideo(-10)" class="btn btn-lg"><i class="fa-regular fa-square-caret-left"></i></button>
                        <button onclick="seekVideo(10)" class="btn btn-lg"><i class="fa-regular fa-square-caret-right"></i></button>
                        
                        <div>
                           <button onclick="changeVideoQuality(720)">Chất lượng 720p</button>
                           
                           <button><a style="text-decoration: none" href="<?php echo e(route('package')); ?>">Chất lượng 4K</a></button>
                        </div>
                        <span>Bạn đang xem phim chất lượng tối đa 720p, mua gói VIP để xem chất lượng 4K</span><br>
                     <?php endif; ?>                     
                 </div>                  
               
                  <div class="clearfix"></div>
                  <div class="clearfix"></div>
                  <div class="title-block">
                     <a href="javascript:;" data-toggle="tooltip" title="Add to bookmark">
                        <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="37976">
                           <div class="halim-pulse-ring" style="margin-top: 12px"></div>
                        </div>
                     </a>
                     <div class="title-wrapper-xem full">
                        <h3 class="entry-title"><a href="<?php echo e(route('movie',$movie->slug)); ?>" title="<?php echo e($movie->title); ?>" class="tl"><?php echo e($movie->title); ?></a></h3>
                     </div>
                  </div>
                  <div class="entry-content htmlwrap clearfix collapse" id="expand-post-content">
                     <article id="post-37976" class="item-content post-37976"></article>
                  </div>
                  <div class="clearfix"></div>
                  <div class="text-center">
                     <div id="halim-ajax-list-server"></div>
                  </div>
                  <div id="halim-list-server">
                     <ul class="nav nav-tabs" role="tablist">
                        <?php if($movie->resolution!=5): ?>
                           <span class="episode"><i aria-hidden="true"></i>
                              <?php if($movie->phude==1): ?>
                                 <li role="presentation" class="active server-1"><a href="#server-0" aria-controls="server-0" role="tab" data-toggle="tab"><i class="hl-server"></i>Thuyết Minh
                                 </a></li>
                              <?php elseif($movie->phude==0): ?>
                                 <li role="presentation" class="active server-1"><a href="#server-0" aria-controls="server-0" role="tab" data-toggle="tab"><i class="hl-server"></i>Vietsub
                                 </a></li>
                              <?php endif; ?>                              
                           </span>
                        <?php endif; ?>
                        
                     </ul>
                     <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active server-1" id="server-0">
                           <div class="halim-server">
                              <ul class="halim-list-eps">
                                 <?php $__currentLoopData = $movie->episode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sotap): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($sotap->episode=='phimle'): ?>
                                       
                                    <?php else: ?>
                                       <a href="<?php echo e(url('xem-phim/'.$movie->slug.'/tap-'.$sotap->episode)); ?>">
                                          <li class="halim-episode"><span class="halim-btn halim-btn-2 <?php echo e($tapphim==$sotap->episode ? 'active' : ''); ?> halim-info-1-1 box-shadow" data-post-id="37976" data-server="1" data-episode="1" data-position="first" data-embed="0" data-title="Xem phim <?php echo e($movie->title); ?> - Tập <?php echo e($sotap->episode); ?> - <?php echo e($movie->name_eng); ?>" data-h1="<?php echo e($movie->title); ?> - tập <?php echo e($sotap->episode); ?>"><?php echo e($sotap->episode); ?></span>
                                          </li>
                                       </a>
                                    <?php endif; ?>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </ul>
                              <div class="clearfix"></div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="htmlwrap clearfix">
                     <div id="lightout"></div>
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


<script>
   function seekVideo(seconds) {
       var video = document.getElementById("videoPlayer");
       video.currentTime += seconds;
   }
</script>      

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\SoureCode\Laravel\new_4kcinema\resources\views/pages/watch.blade.php ENDPATH**/ ?>