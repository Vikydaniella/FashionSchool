<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'category', 'course_code'];

    public function users()
    {
        //return $this->belongsToMany(User::class, 'user_course')->withPivot('enrollment_date');
        return $this->belongsToMany(User::class, 'user_course', 'courses_id', 'user_id')
                    ->withPivot('enrollment_date')
                    ->withTimestamps();
    }
}