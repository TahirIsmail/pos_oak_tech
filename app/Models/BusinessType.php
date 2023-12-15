<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessType extends Model
{
    use HasFactory;
    protected $table = "business_types";
    protected $guarded = [];

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
}