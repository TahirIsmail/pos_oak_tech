<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\SubCategory;

class CategorySpecification extends Model
{
    use HasFactory;
    protected $table = 'category_specifications';
    protected $fillable = ['category_id','sub_category_id', 'category_specification_label', 'created_at', 'updated_at'];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function sub_category(){
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }


    public function child_categories(){
        return $this->belongsTo(ChildCategory::class, 'child_category_id');
    }


    public function category_specification_details(){
        return $this->hasMany(CategorySpecificationDetails::class, 'category_specification_id');
    }
}
