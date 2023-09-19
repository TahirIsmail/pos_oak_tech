<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\StoreScope;
use App\Events\ComplaintCreated;
use Yajra\DataTables\Contracts\DataTable;
class Complaints extends Model
{
    use HasFactory;
    protected $table = 'complaints';
    protected $guards = [];
   
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new StoreScope);
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function linkToProduct(){
        return $this->hasOne(Product::class, 'link_to_complaint');
    }
    public function order(){
        return $this->belongsTo(Order::class, 'order_id');
    }
    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'assign_to_lab_staff_id');
    }
    public function getComplaintCreatedAtAttribute(){
        return Carbon::parse($this->attributes['created_at'])->diffForHumans();
    }
    public function parseDate($date){
        return ($date != null)?Carbon::parse($date)->format(config("app.date_time_format")):null;
    }
}