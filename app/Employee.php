<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $primaryKey = 'id';
    protected $dates = ['created_at', 'updated_at', 'intern_period'];
    protected $fillable = ['user_id', 'name', 'age', 'campus_origin', 'division', 'intern_period', 'photo'];
    public function user() {
        return $this->belongsTo('App\User');
    }
    
    public function attendance() {
        return $this->hasMany('App\Attendance');
    }

    public function leave() {
        return $this->hasMany('App\Leave');
    }

    public function expense() {
        return $this->hasMany('App\Expense');
    }
}