<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierBankDetails extends Model
{
    use HasFactory;
    protected $table = 'supplier_bank_details';
    protected $guarded = [];

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
}
