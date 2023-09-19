<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\StoreScope;

class StaffPayroll extends Model
{
    use HasFactory;
    protected $table = 'staff_payrolls';
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new StoreScope);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'staff_id', 'id');
    }

    public function paySlipAllownace(){
        return $this->hasMany(PaySlipAllowance::class, 'payslip_id');
    }
}
