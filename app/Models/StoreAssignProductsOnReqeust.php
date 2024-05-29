<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreAssignProductsOnReqeust extends Model
{
    use HasFactory;
    protected $table = 'store_assign_products_on_reqeusts';
    protected $guarded = [];


    public function request_to_store(){
        return $this->belongsTo(RequestToStore::class, 'request_to_store_id');
    }
}
