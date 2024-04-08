<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'attendances';
    protected $primaryKey = 'id';
    protected $fillable = ['employee_id', 'entry_ip', 'entry_time', 'entry_location', 'time', 'status'];
    public function employee() {
        return $this->belongsTo('App\Employee');
    }
}