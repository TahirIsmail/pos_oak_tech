<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandForm extends Model
{
    use HasFactory;
    protected $table = 'demand_forms';
    protected $guarded = [];
}
