<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $guarded = [];

    public function department() { return $this->belongsTo(Department::class); }
    public function results() { return $this->hasMany(Result::class); }
    public function attendances() { return $this->hasMany(Attendance::class); }
}
