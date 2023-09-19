<?php

namespace App\Models;
use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
class Expenses extends Model
{
    use HasFactory;
    protected $table = 'expenses';
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new StoreScope);
    }
    public function expenseCategory()
    {
        return $this->belongsTo(MasterExpenseCategory::class,'expense_category','id');
    }
    public function updatedUser(){
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }
    public static function parseDate($date){
        return ($date != null)?Carbon::parse($date)->format(config("app.date_time_format")):null;
    }
    public function createdUser(){
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }
}
