<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\StoreScope;

class StaffAttendance extends Model
{
    use HasFactory;

    protected $table = 'staff_attendances';
    protected $guarded = [];
   

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new StoreScope);
    }

  
    public function user()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }
    
    public function staffAttendanceType()
    {
        return $this->belongsTo(StaffAttendanceType::class, 'staff_attendance_type_id');
    }
}
