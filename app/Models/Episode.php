<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    //Trong tương quan Laravel với mySql, khi đặt tên Model thì không có "s", ví dụ là Episode, 
    //và đặt tên DB-table thì có "s", ví dụ là Episodes,
    //thì khi duyệt qua table, laravel sẽ tự động bỏ chữ "s", và nó hiểu đó là table của thằng model này
    //còn nếu không đặt tên theo quy ước này, thì cần khai báo theo câu lệnh dưới đây
    //ví dụ đặt tên table là TapPhim, thì khai báo trong model:
    //public $table = "TapPhim";
    public $timestamps = false;
    use HasFactory;

    public function movie()
    {
        return $this->belongsTo(Movie::class); //có nghĩa là 1 tập phim chỉ thuộc về 1 phim mà thôi
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}