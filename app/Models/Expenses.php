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
    protected $fillable = ['slack', 'store_id','expense_date', 'expense_name', 'expense_category', 'receipt_upload', 'amount', 'status', 'notes','transaction_id', 'created_by', 'updated_by', 'created_at', 'updated_at'];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new StoreScope);
    }
    public function scopeStatusJoin($query)
    {
        return $query->leftJoin('master_status', function ($join) {
            $join->on('master_status.value', '=', 'expenses.status');
            $join->where('master_status.key', '=', 'EXPENSE_APPROVAL_STATUS');
        });
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function transaction()
    {
        return $this->hasOne(Transaction::class,'id','transaction_id');
    }
    public function expenseCategory()
    {
        return $this->belongsTo(MasterExpenseCategory::class, 'expense_category', 'id');
    }
    public function updatedUser()
    {
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }
    public static function parseDate($date)
    {
        return ($date != null) ? Carbon::parse($date)->format(config("app.date_time_format")) : null;
    }
    public function createdUser()
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }
}
