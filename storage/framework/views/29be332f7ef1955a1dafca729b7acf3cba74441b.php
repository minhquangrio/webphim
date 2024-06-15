
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!--Section: Content-->
<section class="text-center">
  <h4 class="mb-4"><strong>THÔNG TIN CHI TIẾT GÓI</strong></h4>
  <span><a href="<?php echo e(URL::to('/')); ?>">QUAY LẠI TRANG CHỦ</a></span>
  

  <div class="row gx-lg-5 center d-flex justify-content-center">

    <?php if(session('success')): ?>
      <div class="alert alert-success">
        <?php echo e(session('success')); ?>

      </div>
    <?php elseif(session('error')): ?>
      <div class="alert alert-error">
        <?php echo e(session('error')); ?>

      </div>
    <?php endif; ?>  
    
    <!--Grid column-->
    <?php $__currentLoopData = $package; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pack): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-lg-3 col-md-6 mb-4">
      <!-- Thông tin từng gói -->
      <div class="card border border-primary">
        <div class="card-header bg-white py-3">
          <p class="text-uppercase small mb-2" name="pack_name"><strong><?php echo e($pack->name); ?></strong></p>
          <h5 class="mb-0" name="pack_price"><?php echo e(number_format($pack->price)); ?>đ/tháng</h5>
        </div>

        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item" name="pack_quality">
              <?php if($pack->quality==0): ?>
                Quality up to 720p
              <?php elseif($pack->quality==1): ?>
                Quality up to 4K
              <?php endif; ?>
            </li>
            <li class="list-group-item" name="pack_chat">
              <?php if($pack->chat==0): ?>
                No support chat
              <?php elseif($pack->chat==1): ?>
                Support chat
              <?php endif; ?>
            </li>
            <li class="list-group-item" name="pack_hotMovie">
              <?php if($pack->hotMovie==0): ?>
                Không được xem trước phim HOT
              <?php elseif($pack->hotMovie==1): ?>
                Được xem phim HOT trước khi công chiếu
              <?php endif; ?>
            </li>
            <li class="list-group-item" name="pack_bookmark">
              <?php if($pack->bookmark==0): ?>
                Không được lưu phim yêu thích
              <?php elseif($pack->bookmark==1): ?>
                Được lưu phim yêu thích để xem sau
              <?php endif; ?>
            </li>
          </ul>
        </div>

        <div class="card-footer bg-white py-3">
          <?php if($pack->price != 0): ?>
            <form action="<?php echo e(route('check_out', ['id' => $pack->id])); ?>" method="POST">
              <?php echo csrf_field(); ?>
              <?php echo method_field('POST'); ?>
              <input type="hidden" name="pack_id" value="<?php echo e($pack->id); ?>">

              <button type="submit" class="btn btn-danger btn-sm" name="submit">Mua gói này</button>
            </form>
          <?php elseif($pack->price == 0): ?>
            <div><br></div>
          <?php endif; ?>
        </div>
        
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</section>
<!--Section: Content-->
<?php /**PATH D:\SoureCode\Laravel\new_4kcinema\resources\views/pages/package.blade.php ENDPATH**/ ?>