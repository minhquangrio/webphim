
<!-- Lấy templete này nè: https://coreui.io/demos/bootstrap/4.3/dark/colors.html -->

<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/270/270023.png" type="image/x-icon" />
    <title>
        <?php if(isset($movie)): ?>
            <?php echo e($movie->title); ?>

        <?php else: ?>
            Dashboard
        <?php endif; ?>
    </title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                    <?php echo e(config('app.name', 'Laravel')); ?>

                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        <?php if(auth()->guard()->guest()): ?>
                            <?php if(Route::has('login')): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if(Route::has('register')): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php else: ?>
                            <button class="btn btn-primary"><?php echo e(Auth::user()->name); ?></button>
                            
                            <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                <?php echo e(__('Logout')); ?>

                            </a>

                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            
            <div class="container">
                <?php echo $__env->make('layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
            </div>
            
            <div class="container">
                <?php if(Session::has('success')): ?>
                    <div id="welcome-alert" class="alert alert-success" role="alert">
                        <?php echo e(Session::get('success')); ?>

                    </div>
                    <script>
                        // Tự động ẩn thông báo sau 2 giây
                        setTimeout(function(){
                            document.getElementById('welcome-alert').style.display = 'none';
                        }, 2000);
                    </script>
                <?php endif; ?>
            </div>
            
            <?php echo $__env->yieldContent('content'); ?>  
        </main>
    </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>


<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('description');
</script>


<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#tablePhim').DataTable();
    });
</script>


<script type="text/javascript">
    function ChangeToSlug() { 
        var slug;
        //Lấy text từ thẻ input title
        slug = document.getElementById("slug").value;
        slug = slug.toLowerCase();
        //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặc biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\= |\,|\.|\/|\?|\>|\< |\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp user nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\- |\-\@|\@/gi, '');
        //In slug ra textbox có id "convert_slug_vi"
            document.getElementById("convert_slug").value = slug;
     }
</script>



<script type="text/javascript">
    $('.order_position').sortable({
        // khi nắm kéo, ở chỗ khoảng trống chèn vào sẽ có màu
        // ui-state-highlight là class có sẵn của sortable
        placeholder : 'ui-state-highlight', 
        update : function(event, ui){
            var array_id = [];
            $('.order_position tr').each(function(){ //each(function) là vòng lặp của jquery
                array_id.push($(this).attr('id')); //push là đẩy vào, pull là lấy ra //attr là attribute, nhưng trong jquery viết tắt là attr
            })
            $.ajax({
                headers: { // headers định nghĩa dữ liệu là loại nào trước khi gửi vào ajax
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') //trong php, khi gửi form mặc định phải gửi kèm token, hãy kéo file này lên trên đầu, ta thấy laravel mặc định tạo 1 thẻ meta có name là csrf-token
                },
                url: "<?php echo e(route('resorting')); ?>",
                method: "POST",
                data: {array_id : array_id},
                success : function(data){
                    alert('Bạn vừa thực hiện thay đổi thứ tự!');
                }
            })
        }
    })
</script>


<script type="text/javascript">
    $('.select_year').change(function(){
        var year = $(this).find(':selected').val();
        var id_phim = $(this).attr('id');
        // Khi đang viết jQuery có thể dùng alert để kiểm tra mình đã lấy được dữ liệu đúng chưa
        // alert(year);
        // alert(id_phim);
        $.ajax({
            url:"<?php echo e(url('/update-year-phim')); ?>",
            method: "GET",
            data:{year: year, id_phim: id_phim},
            success:function(){
                alert('Thay đổi năm phát hành: ' + year + ' thành công!');
            }
        });
    })
</script>


<script type="text/javascript">
    $('.select_season').change(function(){
        var season = $(this).find(':selected').val();
        var id_phim = $(this).attr('id');
        $.ajax({
            url:"<?php echo e(url('/update-season-phim')); ?>",
            method: "GET",
            data:{season: season, id_phim: id_phim},
            success:function(){
                alert('Phim đã được cập nhật thành mùa ' + season + '!');
            }
        });
    })
</script>


<script type="text/javascript">
    $('.select_topview').change(function(){
        var topview = $(this).find(':selected').val();
        var id_phim = $(this).attr('id');
        if(topview==0){
            var text = "Ngày";
        }else if(topview==1){
            var text = "Tuần";
        }else{
            var text = "Tháng";
        }
        
        $.ajax({
            url:"<?php echo e(url('/update-topview-phim')); ?>",
            method: "GET",
            data:{topview: topview, id_phim: id_phim},
            success:function(){
                alert('Thay đổi phim thành Top View của ' + text + ' thành công!');
            }
        });
    })
</script>


<script type="text/javascript">
    $('.category_choose').change(function(){
    var category_id = $(this).val();
    var movie_id = $(this).attr('id');
    
    $.ajax({
        url:"<?php echo e(route('update_category_ajax')); ?>",
        method:"GET",
        data:{category_id:category_id, movie_id:movie_id},
        success:function(data){
            alert('Thay đổi thành công!');
        }
    });
});
</script>


<script type="text/javascript">
    $('.country_choose').change(function(){
    var country_id = $(this).val();
    var movie_id = $(this).attr('id');
    
    $.ajax({
        url:"<?php echo e(route('update_country_ajax')); ?>",
        method:"GET",
        data:{country_id:country_id, movie_id:movie_id},
        success:function(data){
            alert('Thay đổi thành công!');
        }
    });
});
</script>


<script type="text/javascript">
    $('.select_movie').change(function(){
        var id = $(this).val();        
        $.ajax({
            url:"<?php echo e(route('select-movie')); ?>",
            method: "GET",
            data:{id: id},
            success:function(data)
            {
                $('#show_episode').html(data);
            }
        });
    })
</script>    


    
</body>
</html>
<?php /**PATH D:\SoureCode\Laravel\new_4kcinema\resources\views/layouts/app.blade.php ENDPATH**/ ?>