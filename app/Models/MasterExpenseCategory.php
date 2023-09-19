<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterExpenseCategory extends Model
{
    use HasFactory;
    protected $table = 'master_expense_categories';
    protected $guarded = [];


    public function expense(){
        return $this->hasMany(Expense::class,'id','expense_category');
    }
}