<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationRequest extends Model
{
    use HasFactory;
    protected $table = 'quotation_requests';
    protected $guarded = [];  


    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
