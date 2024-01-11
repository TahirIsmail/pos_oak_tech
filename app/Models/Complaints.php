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
    protected $guarded = [];
   
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new StoreScope);
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function linkToProduct(){
        return $this->hasMany(Product::class, 'link_to_complaint');
    }
    public function order(){
        return $this->belongsTo(Invoice::class, 'order_id');
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

    public function complaintCharges(){
        return $this->hasMany(ComplaintCharge::class, 'complaint_id');
    }

    public function transactions(){
        return $this->hasMany('App\Models\Transaction', 'bill_to_id', 'id')->whereIn('transactions.bill_to',['COMPLAINTS'])->orderBy('transactions.id', 'desc');
    }
    public function storeData(){
        return $this->hasOne('App\Models\Store', 'id', 'store_id');
    }
}
