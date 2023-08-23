<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierPerformance extends Model
{
    use HasFactory;
    protected $table = 'supplier_performances'; // Specify the table name if it's different
    
    protected $fillable = [
        'slack',
        'store_id',
        'supplier_id',
        'status',
        'address',
        'delivery_timeline',
        'rating_delivery_timeline',
        'product_quality',
        'rating_product_quality',
        'responsiveness',
        'rating_responsiveness',
    ];

    // Define the relationships
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
