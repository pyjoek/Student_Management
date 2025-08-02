<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['course'];

    public function lecture()
    {
        return $this->hasMany(Lecture::class);
    }

    use HasFactory;
}
