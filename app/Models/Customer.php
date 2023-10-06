<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'customers';
    // protected $hidden = ['id'];
    protected $fillable = ['slack','customer_type','password', 'init_password', 'name', 'email', 'phone', 'address', 'city', 'country' , 'dob', 'father_name', 'gender', 'cnic', 'status','user_id', 'created_by', 'updated_by', 'created_at', 'updated_at'];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeSkipDefaultCustomer($query)
    {
        return $query->where('customer_type', '!=', 'DEFAULT');
    }

    public function scopeStatusJoin($query)
    {
        return $query->leftJoin('master_status', function ($join) {
            $join->on('master_status.value', '=', 'customers.status');
            $join->where('master_status.key', '=', 'CUSTOMER_STATUS');
        });
    }

    public function scopeCreatedUser($query)
    {
        return $query->leftJoin('users AS user_created', function ($join) {
            $join->on('user_created.id', '=', 'customers.created_by');
        });
    }

    public function scopeUpdatedUser($query)
    {
        return $query->leftJoin('users AS user_updated', function ($join) {
            $join->on('user_created.id', '=', 'customers.updated_by');
        });
    }

    /* For view files */

    public function createdUser()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by')->select(['slack', 'fullname', 'email', 'user_code']);
    }

    public function updatedUser()
    {
        return $this->hasOne('App\Models\User', 'id', 'updated_by')->select(['slack', 'fullname', 'email', 'user_code']);
    }

    public function status_data()
    {
        return $this->hasOne('App\Models\MasterStatus', 'value', 'status')->where('key', 'SUPPLIER_STATUS');
    }

    public function parseDateOnly($date)
    {
        return ($date != null) ? Carbon::parse($date)->format(config("app.date_format")) : null;
    }

    public function parseDate($date)
    {
        return ($date != null) ? Carbon::parse($date)->format(config("app.date_time_format")) : null;
    }
   
    public function user(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }


    public function complaint(){
        return $this->hasMany(Complaint::class, 'customer_id', 'id');
    }


    public function orders(){
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }

    
}
