<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GstOnProduct extends Model
{
    use HasFactory;
    protected $table = 'gst_on_products';
    protected $guarded = [];


    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
