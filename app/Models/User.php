<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class User extends Model
{
    protected $table = 'users';
    protected $hidden = [ 'password', 'role_id'];
    protected $fillable = ['id', 'slack', 'user_code', 'fullname', 'email', 'password', 'init_password', 'phone', 'profile_image', 'role_id', 'status', 'line_manager' , 'created_by', 'updated_by'];



    public function manager()
    {
        return $this->belongsTo(User::class, 'line_manager');
    }

    public function employees()
    {
        return $this->hasMany(User::class, 'line_manager');
    }


    public function leavesAsStaff()
    {
        return $this->hasMany(Leave::class, 'staff_id');
    }

    public function leavesAsLineManager()
    {
        return $this->hasMany(Leave::class, 'line_manager');
    }

    public function approvedLeave()
    {
        return $this->hasMany(Leave::class, 'approved_by');
    }

    public function appliedBy()
    {
        return $this->hasMany(Leave::class, 'applied_by');
    }
    public function transactions(){
        return $this->hasMany('App\Models\Transaction', 'bill_to_id', 'id')->whereIn('transactions.bill_to',['STAFF'])->orderBy('transactions.id', 'desc');
    }
    public function scopeActive($query){
        return $query->where('users.status', 1);
    }
    public function scopeRoleJoin($query){
        return $query->leftJoin('roles', function ($join) {
            $join->on('roles.id', '=', 'users.role_id');
        });
    }

    public function scopeStatusJoin($query){
        return $query->leftJoin('master_status', function ($join) {
            $join->on('master_status.value', '=', 'users.status');
            $join->where('master_status.key', '=', 'USER_STATUS');
        });
    }

    public function scopeSuperAdminStoreData($query){
        return $query->leftJoin('stores', function ($join) {
            $join->on('stores.id', '=', 'users.store_id');
        });
    }

    public function scopeUserStoreData($query){
        return $query->leftJoin('user_stores', function ($join) {
            $join->on('user_stores.store_id', '=', 'users.store_id');
            $join->where('user_stores.user_id', '=', 'users.id');
        });
    }

    public function scopeUserStoreAccessData($query){
        return $query->leftJoin('user_stores', function ($join) {
            $join->on('user_stores.user_id', '=', 'users.id');
        });
    }

    public function scopeStoreData($query){
        return $query->leftJoin('stores', function ($join) {
            $join->on('stores.id', '=', 'user_stores.store_id');
        });
    }

    public function scopeHideSuperAdminRole($query){
        return $query->where('users.role_id', '!=', 1);
    }

    public function scopeHideCurrentLoggedUser($query, $logged_user_id){
        return $query->where('users.id', '!=', $logged_user_id);
    }

    public function scopeCreatedUser($query){
        return $query->leftJoin('users AS user_created', function ($join) {
            $join->on('user_created.id', '=', 'users.created_by');
        });
    }

    public function scopeUpdatedUser($query){
        return $query->leftJoin('users AS user_updated', function ($join) {
            $join->on('user_created.id', '=', 'users.updated_by');
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
        return $this->hasOne('App\Models\MasterStatus', 'value', 'status')->where('key', 'USER_STATUS');
    }

    public function role(){
        return $this->hasOne('App\Models\Role', 'id', 'role_id');
    }
    
    public function parseDate($date){
        return ($date != null)?Carbon::parse($date)->format(config("app.date_time_format")):null;
    }
    public function products(){
        return $this->belongsTo('App\Models\Product', 'created_by', 'id');
    }

    public function staffAttendances()
    {
        return $this->hasMany(StaffAttendance::class, 'staff_id', 'id');
    }

    public function staffPayrolls()
    {
        return $this->hasMany(StaffPayroll::class, 'staff_id', 'id');
    }
    
}