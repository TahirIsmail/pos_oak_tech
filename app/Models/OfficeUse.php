<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeUse extends Model
{
    use HasFactory;
    
    protected $table = 'office_use';
    protected $fillable = [
        'interview_detail_id',
        'approved_by',
        'salary',
        'joining_date',
        'probation_period',
        'increment_probation'
    ];
    // Define the inverse of the one-to-one relationship
    public function interviewDetail()
    {
        return $this->belongsTo(InterviewDetail::class, 'interview_detail_id');
    }
}
