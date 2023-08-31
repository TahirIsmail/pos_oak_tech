<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\StoreScope;

class Leave extends Model
{
    use HasFactory;
    protected $table = 'leaves';
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new StoreScope);
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function lineManager()
    {
        return $this->belongsTo(User::class, 'line_manager');
    }

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type_id');
    }



}
