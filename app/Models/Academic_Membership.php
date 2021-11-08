<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academic_Membership extends Model
{
    use HasFactory;

    protected $primaryKey = 'academic_member_id';
    protected $table = 'academic_membership';

    protected $fillable = [
        
        'course_id',
        'first_name',
        'middle_name',
        'last_name',
        'mobile_number',
        'student_number',
        'email',
        'gender',
        'date_of_birth',
        'year_and_section',
        'subscription',
        'approval_status',
        'validity'
    ];

    
}
