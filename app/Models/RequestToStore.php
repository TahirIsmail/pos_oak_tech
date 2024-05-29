<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestToStore extends Model
{
    use HasFactory;
    protected $table = 'request_to_stores';
    protected $guarded = [];


    public function part_request(){
        return $this->belongsTo(PartRequest::class, 'request_id');
    }
    public function complaint(){
        return $this->belongsTo(Complaints::class, 'complaint_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function store_assign_products_on_reqeusts(){
        return $this->hasMany(StoreAssignProductsOnReqeust::class, 'request_to_store_id');
    }
}
