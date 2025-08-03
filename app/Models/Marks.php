<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marks extends Model
{
    protected $fillable = ['student', 'course', 'module', 'marks'];
    use HasFactory;
}
