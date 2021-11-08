<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expected_Applicants extends Model
{
    use HasFactory;

    protected $table = 'expected_applicants';

    protected $primaryKey = "expected_applicant_id";

    protected $fillable = [
        
        'first_name',
        'middle_name',
        'last_name',
        'student_number',
       
    ];
}
