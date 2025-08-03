<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['course'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'course_lectures', 'course_id', 'user_id')
                    ->using(CourseLecture::class)
                    ->withTimestamps();
    }

    public function course_lectures()
    {
        return $this->hasMany(CourseLecture::class);
    }

    public function academy()
    {
        return $this->hasMany(Academy::class);
    }

    public function student()
    {
        return $this->hasMany(Student::class);
    }

    

    use HasFactory;
}
