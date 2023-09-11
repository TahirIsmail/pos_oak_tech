<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\StoreScope;

class LeaveType extends Model
{
    use HasFactory;
    protected $table = 'leave_types';
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new StoreScope);
    }
    public function leaves()
    {
        return $this->hasMany(Leave::class, 'leave_type_id');
    }
}
