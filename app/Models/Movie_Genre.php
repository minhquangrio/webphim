<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie_Genre extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'movie_genre'; //khai báo cho php biết model Movie_Genre thuộc bảng movie_genre trong CSDL, thật ra nếu đặt tên bảng và cột trong CSDL đúng quy tắc của laravel, thì không cần khai báo dòng này
}