<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

use App\Models\Scopes\StoreScope;

class Supplier extends Model
{
    protected $table = 'suppliers';
    // protected $hidden = ['id'];
    protected $fillable = ['id', 'slack', 'store_id', 'supplier_code', 'supplier_id', 'name', 'email', 'phone', 'address','city', 'country', 'gender', 'pincode', 'status', 'created_by', 'updated_by'];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new StoreScope);
    }
    
    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function scopeSkipDefaultSupplier($query)
    {
        return $query->where('supplier_type', '!=', 'DEFAULT');
    }


    public function scopeDefaultSupplier($query)
    {
        return $query->where('supplier_type', '==', 'DEFAULT');
    }


    public function supplierPerformances()
    {
        return $this->hasMany(SupplierPerformance::class, 'supplier_id');
    }

    public function scopeStatusJoin($query){
        return $query->leftJoin('master_status', function ($join) {
            $join->on('master_status.value', '=', 'suppliers.status');
            $join->where('master_status.key', '=', 'SUPPLIER_STATUS');
        });
    }

    public function scopeSortNameAsc($query){
        return $query->orderBy('suppliers.name', 'asc');
    }

    public function scopeCreatedUser($query){
        return $query->leftJoin('users AS user_created', function ($join) {
            $join->on('user_created.id', '=', 'suppliers.created_by');
        });
    }

    public function scopeUpdatedUser($query){
        return $query->leftJoin('users AS user_updated', function ($join) {
            $join->on('user_created.id', '=', 'suppliers.updated_by');
        });
    }

    /* For view files */

    public function createdUser(){
        return $this->hasOne('App\Models\User', 'id', 'created_by')->select(['slack', 'fullname', 'email', 'user_code']);
    }

    public function updatedUser(){
        return $this->hasOne('App\Models\User', 'id', 'updated_by')->select(['slack', 'fullname', 'email', 'user_code']);
    }
    
    public function status_data(){
        return $this->hasOne('App\Models\MasterStatus', 'value', 'status')->where('key', 'SUPPLIER_STATUS');
    }

    public function parseDate($date){
        return ($date != null)?Carbon::parse($date)->format(config("app.date_time_format")):null;
    }

    public function bank_details(){
        return $this->hasMany(SupplierBankDetails::class);
    }

    public function business_type(){
        return $this->hasMany(BusinessType::class);
    }

    public function contact_persons(){
        return $this->hasMany(ContactPerson::class);
    }

    public function user(){
        return $this->belongsTo(User::class, "id", "supplier_id");
    }
}
