<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['student_id', 'status', 'date'];
    
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    use HasFactory;
}
