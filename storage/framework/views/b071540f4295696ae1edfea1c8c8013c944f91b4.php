
<?php $__env->startSection('content'); ?>
<div class="row container" id="wrapper">
            <div class="halim-panel-filter">
               <div class="panel-heading">
                  <div class="row">
                     <div class="col-xs-6">
                        <div class="yoast_breadcrumb hidden-xs"><span><span><a href=""><?php echo e($cate_slug->title); ?></a> » <span class="breadcrumb_last" aria-current="page"><?php echo e(date('Y')); ?></span></span></span></div>
                     </div>
                  </div>
               </div>
               <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                  <div class="ajax"></div>
               </div>
            </div>
            <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
               <section>
                  <div class="section-bar clearfix">
                     <h1 class="section-title"><span><?php echo e($cate_slug->title); ?></span></h1>
                  </div>
                  
                  <div class="halim_box">
                     <?php $__currentLoopData = $movie; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $mov): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
                        <div class="halim-item">
                           <a class="halim-thumb" href="<?php echo e(route('movie',$mov->slug)); ?>">
                              <figure><img class="lazy img-responsive" src="<?php echo e(asset('uploads/movie/'.$mov->image)); ?>" alt="" title="<?php echo e($mov->title); ?>"></figure>
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
                  <div class="clearfix"></div>

                  
                  <div class="text-center">
                     
                     <?php echo $movie->links("pagination::bootstrap-4"); ?>

                     
                  </div>
                  
                  
               </section>
            </main>
            <!-- Sidebar -->
            <?php echo $__env->make('pages.include.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
         </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\SoureCode\Laravel\new_4kcinema\resources\views/pages/category.blade.php ENDPATH**/ ?>