<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartRequest extends Model
{
    use HasFactory;
    protected $table = 'part_requests';
    protected $guarded = [];

    public function complaint(){
        return $this->belongsTo(Complaints::class, 'complaint_id');
    }

    public function engineer(){
        return $this->belongsTo(User::class, 'engineer_id');
    }

    public function request_to_store(){
        return $this->hasMany(RequestToStore::class, 'request_id');
    }
}
