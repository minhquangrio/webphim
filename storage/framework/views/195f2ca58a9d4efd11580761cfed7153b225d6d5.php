


<?php $__env->startSection('content'); ?>
<div class="row container" id="wrapper">
            <div class="halim-panel-filter">
               <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                  <div class="ajax"></div>
               </div>
            </div>
            
            <div id="halim_related_movies-2" class="wrap-slider">
               <div class="section-bar clearfix">
                  <h3 class="section-title"><span>PHIM HOT</span></h3>
               </div>
               <div id="halim_related_movies-200" class="owl-carousel owl-theme related-film">
                  
                  <?php $__currentLoopData = $phimhot; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $mov): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                  <article class="thumb grid-item post-38498">
                     <div class="halim-item">
                        <a class="halim-thumb" href="<?php echo e(route('movie',$mov->slug)); ?>" title="<?php echo e($mov->title); ?>">
                           <figure><img class="lazy img-responsive" src="<?php echo e(asset('uploads/movie/'.$mov->image)); ?>" alt="<?php echo e($mov->title); ?>" title="<?php echo e($mov->title); ?>"></figure>
                           <span class="status">
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
                           </span>

                           <!--Hiển thị Vietsub /Thuyết Minh-->
                              <?php if($mov->resolution!=5): ?>
                                 </span><span class="episode"><i aria-hidden="true"></i>
                                    <?php if($mov->phude==1): ?>
                                       Thuyết Minh
                                    <?php elseif($mov->phude==0): ?>
                                       Vietsub
                                    <?php endif; ?>                              
                                 </span>
                              <?php endif; ?>

                           <div class="icon_overlay"></div>
                           <div class="halim-post-title-box">
                              <div class="halim-post-title ">
                                 <p class="entry-title"><?php echo e($mov->title); ?></p>
                                 <p class="original_title"><?php echo e($mov->name_eng); ?></p>
                                 <p class="original_title">
                                    <?php if($mov->season!=0): ?>
                                       Season <?php echo e($mov->season); ?>

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
                  var owl = $('#halim_related_movies-200');
                  owl.owlCarousel({
                     loop: true,
                     margin: 4,
                     autoplay: true,
                     autoplayTimeout: 2000,
                     autoplayHoverPause: true,
                     nav: true,
                     navText: ['<i class="fa-solid fa-chevron-left"></i>', '<i class="fa-solid fa-chevron-right"></i>'],
                     responsiveClass: true,
                     responsive: {0: {items:2},480: {items:3}, 600: {items:4},1000: {items: 6}}})});
               </script>
            </div>
            

            
            <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
               <?php $__currentLoopData = $category_home; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cate_home): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <section id="halim-advanced-widget-2">
                  <div class="section-heading">
                     <a href="<?php echo e(route('category',$cate_home->slug)); ?>" title="<?php echo e($cate_home->title); ?>">
                     <span class="h-text"><?php echo e($cate_home->title); ?></span>
                     </a>
                  </div>
                  <div id="halim-advanced-widget-2-ajax-box" class="halim_box">
                     <!--Xem file IndexController ta thấy $category_home là biến toàn cục, nó suy ra biến $cate_home, mà trong cate_home thì chứa movie, nên ta viết $cate_home->movie để lấy ra toàn bộ dữ liệu của movie-->
                     
                     
                     <?php $__currentLoopData = $cate_home->movie->sortByDesc('id')->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $mov): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
                           <div class="halim-item">
                              <a class="halim-thumb" href="<?php echo e(route('movie',$mov->slug)); ?>">
                                 <figure><img class="lazy img-responsive" src="<?php echo e(asset('uploads/movie/'.$mov->image)); ?>" alt="<?php echo e($mov->title); ?>" title="<?php echo e($mov->title); ?>"></figure>
                                 <span class="status">
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
                                 </span>

                                 <!--Hiển thị Vietsub /Thuyết Minh-->
                                 <?php if($mov->resolution!=5): ?>
                                    <span class="episode"><i aria-hidden="true"></i>
                                       <?php if($mov->phude==1): ?>
                                          Thuyết Minh
                                       <?php elseif($mov->phude==0): ?>
                                          Vietsub
                                       <?php endif; ?>                              
                                    </span>
                                 <?php endif; ?>

                                 <div class="icon_overlay"></div>
                                 <div class="halim-post-title-box">
                                    <div class="halim-post-title ">
                                       <p class="entry-title"><?php echo e($mov->title); ?></p>
                                       <p class="original_title"><?php echo e($mov->name_eng); ?></p>
                                       <p class="original_title">
                                          <?php if($mov->season!=0): ?>
                                             Season <?php echo e($mov->season); ?>

                                          <?php endif; ?>
                                       </p>
                                    </div>
                                 </div>
                              </a>
                           </div>
                        </article> 
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                        
                  </div>
               </section>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               <div class="clearfix"></div>
            </main>
            

            <!-- Sidebar -->
            <?php echo $__env->make('pages.include.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
         </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\SoureCode\Laravel\new_4kcinema\resources\views/pages/home.blade.php ENDPATH**/ ?>