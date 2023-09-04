<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\StoreScope;
use Yajra\DataTables\Contracts\DataTable;
class Complaints extends Model
{
    use HasFactory;
    protected $table = 'complaints';
    // protected $hidden = ['id'];
    protected $fillable = ['slack', 'store_id', 'complaint_ref', 'complaint_status', 'descriptions', 'created_by', 'updated_by', 'complaint_by ', 'assigned_to', 'created_at', 'updated_at'];
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new StoreScope);
    }
    
    
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to','id');
    }

    public function complaintBy()
    {
        return $this->belongsTo(Customer::class, 'complaint_by','id');
    }

    public function store(){
        return $this->belongsTo(Store::class, 'store_id','id');
        
    }

    public function createdUser(){
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }

    public function updatedUser(){
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }
    public function parseDate($date){
        return ($date != null)?Carbon::parse($date)->format(config("app.date_time_format")):null;
    }
}
