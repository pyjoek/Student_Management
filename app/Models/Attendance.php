<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['student_id', 'status', 'date'];
    public function student()
    {
        return $this->hasMany(Student::class);
    }
    use HasFactory;
}
