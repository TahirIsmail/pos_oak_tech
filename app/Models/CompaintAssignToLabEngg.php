<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompaintAssignToLabEngg extends Model
{
    use HasFactory;
    protected $table = 'compaint_assign_to_lab_enggs';
    protected $guarded = [];

    public function complaint(){
        return $this->belongsTo(Complaints::class, 'complaint_id');
    }


    public function users(){
        return $this->belongsTo(User::class, 'engg_id');
    }



    public function part_requests(){
        return $this->hasMany(PartRequest::class, 'assign_complaint_id');
    }

    public function out_source_complaints(){
        return $this->hasMany(OutSourceComplaint::class, 'lab_complaint_id');
    }
}
