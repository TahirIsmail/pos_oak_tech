<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutSourceComplaint extends Model
{
    use HasFactory;

    protected $table = 'out_source_complaints';
    protected $guarded = [];


    public function complaint(){
        return $this->belongsTo(Complaints::class, 'complaint_id');
    }
    public function vendor(){
        return $this->belongsTo(User::class, 'vendor_id');
    }
    public function engineer(){
        return $this->belongsTo(User::class, 'engineer_id');
    }
}
