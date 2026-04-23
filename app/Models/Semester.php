<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $guarded = [];

    public function students() { return $this->hasMany(Student::class); }
    public function results() { return $this->hasMany(Result::class); }
}
