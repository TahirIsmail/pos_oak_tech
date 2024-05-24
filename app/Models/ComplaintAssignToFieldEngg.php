<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintAssignToFieldEngg extends Model
{
    use HasFactory;
    protected $table = "complaint_assign_to_field_enggs";
    protected $guarded = [];

    public function complaint(){
        return $this->belongsTo(Complaints::class, 'complaint_id');
    }
}
