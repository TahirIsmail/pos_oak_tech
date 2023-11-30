<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorySpecificationDetails extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category_specification(){
        return $this->belongsTo(CategorySpecification::class, 'category_specification_id');
    }


    public function product_specification(){
        return $this->hasOne(ProductSpecifications::class, 'specification_details');
    }
}