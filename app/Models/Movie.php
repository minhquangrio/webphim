<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public $timestamps = false;
    use HasFactory;

    //Viết như 3 hàm bên dưới thì ta hiểu: 1 phim thuộc về 1 danh mục, 1 quốc gia và 1 thể loại (dùng belongsTo - quan hệ 1-1). Đây là cơ bản, trên thực tế 1 phim có thể thuộc nhiều danh mục/quốc gia/thể loại, ta sẽ tìm hiểu sau.
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id'); //categories là bảng, category_id là khóa ngoại của bảng categories (nằm trong bảng movies), còn id là khóa chính của bảng categories.
        //Lưu ý nếu ta đặt tên trong CDSL chuẩn từ đầu, thì có thể không cần viết ra 3 tham số này.
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id', 'id');
    }


    //Cách khai báo một 1 Phim thuộc về nhiều Thể Loại:
    public function movie_genre()
    { //movie_genre() chỉ là tên hàm thôi nha
        return $this->belongsToMany(Genre::class, 'movie_genre', 'movie_id', 'genre_id'); //trong dòng này: movie_genre là tên bảng trung gian, còn movie_id và genre_id là 2 khóa ngoại, nằm trong bảng movie_genre
    }

    public function episode()
    {
        return $this->hasMany(Episode::class); //có nghĩa là 1 phim sẽ có nhiều tập
    }
    public function bookmark()
    {
        return $this->hasMany(Bookmark::class); //có nghĩa là 1 phim sẽ có nhiều bookmark
    }
}