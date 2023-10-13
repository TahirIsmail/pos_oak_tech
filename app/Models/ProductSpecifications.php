<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSpecifications extends Model
{
    use HasFactory;
    protected $table = 'product_specifications';
    protected $fillable = ['product_id','specification_label', 'specification_details', 'created_at', 'updated_at'];



    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
