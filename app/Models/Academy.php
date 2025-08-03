<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academy extends Model
{
    protected $fillable = ['course_id', 'module'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    use HasFactory;
}
