<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerContactPerson extends Model
{
    use HasFactory;
    protected $table = 'customer_contact_people';
    protected $guarded = [];
}
