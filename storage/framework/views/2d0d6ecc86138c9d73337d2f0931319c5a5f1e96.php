



<?php $__env->startSection('content'); ?>
<style>
    .required-label::after {
    content: '*';
    color: red;
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-14">
            <div class="card" >
                <div class="card-header">QUẢN LÝ NGƯỜI DÙNG</div>
                <a href="<?php echo e(route('manageUser.create')); ?>" class="btn btn-primary">Thêm người dùng mới</a>
                <div class="card-body" >
                    
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
                    <!--FORM CHO PHÉP THÊM MỘT TÀI KHOẢN NGƯỜI DÙNG MỚI-->
                    <?php if(!isset($user)): ?>
                        <?php echo Form::open(['route'=>'manageUser.store', 'method'=>'POST']); ?>

                    <?php else: ?>
                        <?php echo Form::open(['route'=>['manageUser.update', $user->id], 'method'=>'PUT']); ?> 
                    <?php endif; ?>
                        <!--Tên-->
                        <div class=form-group>
                            <?php echo Form::label('name', 'Name', []); ?>

                            <?php echo Form::text(
                                'name', 
                                isset($user) ? $user->name : '',
                                [
                                    'class'=>'form-control', 
                                    'placeholder'=>'Nhập tên người dùng, không chứa số hoặc ký tự đặc biệt',
                                    'required' => 'required',
                                    'id' => 'userName',
                                    'autofocus' => 'autofocus',
                                    'onkeyup' => 'validateName()'
                                ]); ?>

                            <p style="color:rgb(163, 36, 17)" id="result1"></p>
                        </div>
                        <!--Email-->
                        <div class=form-group>
                            <?php echo Form::label('email', 'Email', []); ?>

                            <?php echo Form::text(
                                'email', 
                                isset($user) ? $user->email : '',
                                [
                                    'class'=>'form-control', 
                                    'placeholder'=>'Nhập email',
                                    'required' => 'required',
                                    'id' => 'userEmail',
                                    'onkeyup' => 'validateEmail()'
                                ]); ?>

                            <p style="color:rgb(163, 36, 17)" id="result2"></p>
                        </div>
                        <!--Mật khẩu-->
                        <div class="form-group password-toggle">
                            <?php echo Form::label('password', 'Password', []); ?>

                            <?php echo Form::text('password', '', 
                                [
                                    'class' => 'form-control', 
                                    'placeholder' => 'Nhập mật khẩu: ít nhất 6 ký tự, có 1 ký tự in hoa', 
                                    'id' => 'userPassword',
                                    'required' => 'required',
                                    'onkeyup' => 'validatePassword()'
                                ]); ?>

                            <p style="color:rgb(163, 36, 17)" id="result3"></p>
                        </div>
                        <!--Quyền truy cập-->
                        <div class=form-group>
                            <?php echo Form::label('role', 'ROLE', []); ?>

                            <?php echo Form::select('role', 
                            ['1' => 'ADMIN', '2' => 'USER'], 
                            isset($user) ? $user->role : '',
                            ['class' => 'form-control']
                            ); ?>

                        </div>
                        <!--Đã mua gói VIP hay chưa-->
                        <div class=form-group>
                            <?php echo Form::label('isVip', 'Người dùng đã mua gói VIP', []); ?>

                            <?php echo Form::select('isVip', 
                            ['0' => 'Chưa mua gói', '1' => 'Đã mua gói'], 
                            isset($user) ? $user->isVip : '',
                            ['class' => 'form-control']
                            ); ?>

                        </div>
                        <!--Trạng thái-->
                        <div class=form-group>
                            <?php echo Form::label('active', 'Active', []); ?>

                            <?php echo Form::select('status',
                            ['1'=>'Hiển thị', '0'=>'Ẩn'],
                            isset($user) ? $user->status : 'Hiển thị',
                            ['class'=>'form-control']); ?>

                        </div>

                        <?php if(!isset($country)): ?>
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
                    <th scope="col">NAME</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">PASSWORD</th>
                    <th scope="col">ROLE</th>
                    <th scope="col">NGƯỜI DÙNG VIP</th>
                    <th scope="col">HIỂN THỊ / ẨN</th>
                    <th scope="col">QUẢN LÝ</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <th scope="row"><?php echo e($key+1); ?></th>
                        <td><?php echo e($cate->name); ?></td>
                        <td><?php echo e($cate->email); ?></td>
                        <td>
                            <span class="password-placeholder">*******</span>
                            <span class="password-original" style="display: none;"><?php echo e($cate->plainPassword); ?></span>
                            <button class="show-password-btn" onclick="showPassword(this)">Hiển thị</button>
                            <button class="hide-password-btn" style="display: none;" onclick="hidePassword(this)">Ẩn</button>
                          </td>
                        <td>
                            <?php echo e($cate->role == 1 ? 'ADMIN' : 'USER'); ?>

                        </td>
                        <td>
                            <?php echo e($cate->isVip == 1 ? 'VIP' : 'Chưa mua gói'); ?>

                        </td>
                        <td>
                            <?php echo e($cate->status ? 'Hiển thị' : 'Ẩn'); ?>

                        </td>
                        <td>
                            <?php echo Form::open([
                                'method'=>'DELETE',
                                'route'=>['manageUser.destroy',$cate->id],
                                'onsubmit'=>'return confirm("Xác nhận xóa?")',
                                'class'=>'d-inline-block'
                            ]); ?>

                            <?php echo Form::submit('Xóa', ['class'=>'btn btn-danger']); ?>

                            <?php echo Form::close(); ?>

                            <a href="<?php echo e(route('manageUser.edit', $cate->id)); ?>" class="btn btn-warning d-inline-block">Sửa</a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
        </div>
    </div>
</div>
<script type='text/javascript' src='<?php echo e(asset('js/bootstrap.min.js?ver=5.7.2')); ?>' id='bootstrap-js'></script>
<script type='text/javascript' src='<?php echo e(asset('js/owl.carousel.min.js?ver=5.7.2')); ?>' id='carousel-js'></script>

<script type='text/javascript' src='<?php echo e(asset('js/halimtheme-core.min.js?ver=1626273138')); ?>' id='halim-init-js'></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function showPassword(button) {
        var passwordPlaceholder = button.parentNode.querySelector('.password-placeholder');
        var passwordOriginal = button.parentNode.querySelector('.password-original');
        var hideButton = button.parentNode.querySelector('.hide-password-btn');
  
        passwordPlaceholder.textContent = passwordOriginal.textContent;
        passwordPlaceholder.style.display = 'inline';
        passwordOriginal.style.display = 'none';
  
        button.style.display = 'none';
        hideButton.style.display = 'inline';
    }
  
    function hidePassword(button) {
        var passwordPlaceholder = button.parentNode.querySelector('.password-placeholder');
        var passwordOriginal = button.parentNode.querySelector('.password-original');
        var showButton = button.parentNode.querySelector('.show-password-btn');
  
        passwordPlaceholder.textContent = '*******';
        passwordPlaceholder.style.display = 'inline';
        passwordOriginal.style.display = 'none';
  
        button.style.display = 'none';
        showButton.style.display = 'inline';
    }
</script>


<script>
    function validateName() {
        var name = document.getElementById("userName").value;
        var pattern = /^[a-zA-Z\s]+$/;
        var resultElement = document.getElementById("result1");
        
        if (name.length >= 2 && pattern.test(name) && name.value !="") {
        resultElement.innerHTML = "";
        } else {
        resultElement.innerHTML = "Tên cần ít nhất 2 ký tự và không chứa số, ký tự đặc biệt!";
        }
    }
</script>



<script>
    function validateEmail() {
        var email = document.getElementById("userEmail").value;
        var pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/;
        var resultElement = document.getElementById("result2");
        
        if (pattern.test(email) && email.value !="") {
        resultElement.innerHTML = "";
        } else {
        resultElement.innerHTML = "Email không hợp lệ!";
        }
    }
</script>



<script>
    function validatePassword() {
    var password = document.getElementById("userPassword").value;
    var uppercaseRegex = /[A-Z]/;
    var resultElement = document.getElementById("result3");
    
    if (password.length >= 8 && uppercaseRegex.test(password) && password.value !="") {
        resultElement.innerHTML = "";
    } else {
        resultElement.innerHTML = "Mật khẩu cần từ 8 ký tự và có 1 ký tự hoa!";
    }
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\SoureCode\Laravel\new_4kcinema\resources\views/admincp/user/form.blade.php ENDPATH**/ ?>