<?php
// Ta cần hiểu Model là nơi để lấy dữ liệu từ DB về (theo các nguyên tắc 1-1, 1-nhiều hoặc nhiều-nhiều), còn Controller thì chứa các hàm (function) để xử lý những dữ liệu đó, sau đó đi theo route đã khai báo trong web.php để đưa dữ liệu đã được xử lý đến view nằm trong các file .blade.php để hiển thị ra ngoài trình duyệt cho người dùng sử dụng.

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    use HasFactory;


    //Viết như hàm bên dưới thì ta hiểu 1 danh mục thì có nhiều phim (dùng hasMany - quan hệ 1-nhiều)
    public function movie()
    {
        return $this->hasMany(Movie::class)->orderBy('id', 'DESC'); //hoặc là sắp xếp ở đây luôn, hoặc có thể sắp xếp ngay lúc dùng foreach duyệt qua mảng lấy phim hiển thị ra website.
    }
}