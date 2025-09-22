<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'email', 'regno', 'course_id', 'password'];

    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
}
