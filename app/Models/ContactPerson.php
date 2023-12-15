<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPerson extends Model
{
    use HasFactory;
    protected $table = 'contact_people';
    protected $guarded = [];

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
}
