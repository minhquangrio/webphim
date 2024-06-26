
<aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4" clearfix="overflow: auto;">
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
       <div class="section-bar clearfix">
          <div class="section-title">
             <span>Phim Sắp Chiếu <i class="fa-regular fa-lightbulb"></i></span>
             
          </div>
       </div>
       <section class="tab-content">
          <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
             <div class="halim-ajax-popular-post-loading hidden"></div>
             <div id="halim-ajax-popular-post" class="popular-post">
                <?php $__currentLoopData = $phimhot_trailer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $hot_sidebar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item post-37176">
                   <a href="<?php echo e(route('movie',$hot_sidebar->slug)); ?>" title="<?php echo e($hot_sidebar->title); ?>">
                      <div class="item-link">
                         <img src="<?php echo e(asset('uploads/movie/'.$hot_sidebar->image)); ?>" class="lazy post-thumb" alt="<?php echo e($hot_sidebar->title); ?>" title="<?php echo e($hot_sidebar->title); ?>" />
                         <span class="is_trailer">
                            <?php if($hot_sidebar->resolution==0): ?>
                               720p
                            <?php elseif($hot_sidebar->resolution==1): ?>
                               1080p
                            <?php elseif($hot_sidebar->resolution==2): ?>
                               HD+
                            <?php elseif($hot_sidebar->resolution==3): ?>
                               UHD
                            <?php elseif($hot_sidebar->resolution==4): ?>
                               4K
                            <?php else: ?>
                               Trailer
                            <?php endif; ?>
                         </span>
                      </div>
                      <p class="title"><?php echo e($hot_sidebar->title); ?></p>
                   </a>
                   <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                   <div style="float: left;">
                      <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                      <span style="width: 0%"></span>
                      </span>
                   </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             </div>
          </div>
       </section> 
       <div class="clearfix"></div>
    </div>
 </aside>
 
 
 
 <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4" clearfix="overflow: auto;">
     <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
           <div class="section-title">
              <span>Top Trending <i class="fa-regular fa-star"></i></span>
              
           </div>
        </div>
        <section class="tab-content">
           <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
              <div class="halim-ajax-popular-post-loading hidden"></div>
              <div id="halim-ajax-popular-post" class="popular-post">
                 <?php $__currentLoopData = $phimhot_sidebar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $hot_sidebar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <div class="item post-37176">
                    <a href="<?php echo e(route('movie',$hot_sidebar->slug)); ?>" title="<?php echo e($hot_sidebar->title); ?>">
                       <div class="item-link">
                          <img src="<?php echo e(asset('uploads/movie/'.$hot_sidebar->image)); ?>" class="lazy post-thumb" alt="<?php echo e($hot_sidebar->title); ?>" title="<?php echo e($hot_sidebar->title); ?>" />
                          <span class="is_trailer">
                             <?php if($hot_sidebar->resolution==0): ?>
                                720p
                             <?php elseif($hot_sidebar->resolution==1): ?>
                                1080p
                             <?php elseif($hot_sidebar->resolution==2): ?>
                                HD+
                             <?php elseif($hot_sidebar->resolution==3): ?>
                                UHD
                             <?php elseif($hot_sidebar->resolution==4): ?>
                                4K
                             <?php else: ?>
                                Trailer
                             <?php endif; ?>
                          </span>
                       </div>
                       <p class="title"><?php echo e($hot_sidebar->title); ?></p>
                    </a>
                    <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                    <div style="float: left;">
                       <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                       <span style="width: 0%"></span>
                       </span>
                    </div>
                 </div>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
           </div>
        </section> 
        <div class="clearfix"></div>
     </div>
  </aside>
  
 
  
  <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4" clearfix="overflow: auto;">
     <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
           <div class="section-title">
              <span>Top Views</span>
             </div>
        </div>
         <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
             <li class="nav-item active">
             <a class="nav-link filter-sidebar" id="pills-home-tab" data-toggle="pill" href="#ngay" role="tab" aria-controls="pills-home" aria-selected="true" >Ngày</a>
             </li>
             <li class="nav-item">
             <a class="nav-link filter-sidebar" id="pills-profile-tab" data-toggle="pill" href="#tuan" role="tab" aria-controls="pills-profile" aria-selected="false">Tuần</a>
             </li>
             <li class="nav-item">
             <a class="nav-link filter-sidebar" id="pills-contact-tab" data-toggle="pill" href="#thang" role="tab" aria-controls="pills-contact" aria-selected="false">Tháng</a>
             </li>
         </ul>
        <div class="tab-content" id="pills-tabContent">
             
             
             <div id="halim-ajax-popular-post-default" class="popular-post">
                 <span id="show_data_default"></span>
             </div>
 
 
             
             <div class="tab-pane fade active" id="tuan" role="tabpanel" aria-labelledby="pills-home-tab">
                 <div id="halim-ajax-popular-post" class="popular-post">
                     
                     <span id="show_data"></span>
                 </div>
             </div>
        </div>
 
     
     <div class="clearfix"></div>
     </div>
 </aside>
  <?php /**PATH D:\SoureCode\Laravel\new_4kcinema\resources\views/pages/include/sidebar.blade.php ENDPATH**/ ?>