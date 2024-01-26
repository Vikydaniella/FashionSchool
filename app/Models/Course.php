<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['title', 'category', 'course_code'];

    /**
     * The users that belong to the course.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_course')->withTimestamps();
    }
}