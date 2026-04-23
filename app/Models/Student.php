<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [];

    public function user() { return $this->belongsTo(User::class); }
    public function department() { return $this->belongsTo(Department::class); }
    public function semester() { return $this->belongsTo(Semester::class); }
    public function results() { return $this->hasMany(Result::class); }
    public function attendances() { return $this->hasMany(Attendance::class); }
    public function billings() { return $this->hasMany(Billing::class); }
}
