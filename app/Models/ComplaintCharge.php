<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\StoreScope;

class ComplaintCharge extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new StoreScope);
    }

    public function complaint(){
        return $this->belongsTo(Complaints::class, 'complaint_id');
    }
}
