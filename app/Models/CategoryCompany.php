<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\StoreScope;

class CategoryCompany extends Model
{
    use HasFactory;

    protected $table = 'category_companies';
    protected $hidden = ['store_id'];
    protected $fillable = ['id', 'slack', 'store_id', 'category_company_name', 'category_id','sub_category_id', 'status', 'created_at', 'updated_at'];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new StoreScope);
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function subcategory(){
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
}
