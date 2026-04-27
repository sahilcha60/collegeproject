<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $guarded = [];

    public function schedules() { return $this->hasMany(ExamSchedule::class); }
    public function results()   { return $this->hasMany(Result::class); }
    public function semester()  { return $this->belongsTo(Semester::class); }
}
