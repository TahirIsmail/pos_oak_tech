<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class SubCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'sub_category_id');
    }

    public function category_companies(){
        return $this->hasMany(CategoryCompany::class, 'sub_category_id');
    }
    public function product_names(){
        return $this->hasMany(ProductName::class, 'sub_category_id');
    }
    
    public function category_specifications(){
        return $this->hasMany(CategorySpecification::class, 'sub_category_id');
    }

    public function child_category(){
        return $this->hasMany(ChildCategory::class, 'sub_category_id');
    }

    

}
