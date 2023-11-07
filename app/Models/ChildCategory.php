<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function sub_categories(){
        return $this->belongsTo(SubCategory::class);
    }


    public function category_specifications(){
        return $this->hasMany(CategorySpecification::class, 'child_category_id');
    }
}
