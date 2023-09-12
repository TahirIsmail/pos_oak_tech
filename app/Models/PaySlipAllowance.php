<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaySlipAllowance extends Model
{
    use HasFactory;
    protected $table = 'pay_slip_allowances';
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(StaffPayroll::class, 'payslip_id', 'id');
    }
}
