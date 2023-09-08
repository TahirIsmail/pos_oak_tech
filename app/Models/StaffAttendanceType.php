<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffAttendanceType extends Model
{
    use HasFactory;
    protected $table = 'staff_attendance_types';
    protected $fillable = ['id','type', 'key_value', 'is_active','created_at', 'updated_at'];


    public function staffAttendances()
{
    return $this->hasMany(StaffAttendance::class, 'staff_attendance_type_id');
}
}
