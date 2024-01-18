<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'category', 'course_code'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_course')->withPivot('enrollment_date')->withTimestamps();
    }
}

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class Courses extends Model
// {
//     use HasFactory;
//     protected $fillable = ['title', 'category', 'course_code'];

//     public function users()
//     {
//         return $this->belongsToMany(User::class, 'user_course')->withPivot('enrollment_date')->withTimestamps();
//     }
//}