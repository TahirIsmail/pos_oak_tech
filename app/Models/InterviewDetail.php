<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OfficeUse;

class InterviewDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'position', 'name', 'experience', 'personality', 'job_stability',
        'willingness', 'family_background', 'conveyance', 'documents_attached',
        'grading', 'last_salary', 'salary_agreed', 'interview_taken',
    ];

    // Define the one-to-one relationship with OfficeUse
    public function officeUse()
    {
        return $this->hasOne(officeUse::class, 'interview_detail_id');
    }
}
