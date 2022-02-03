<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academic_Members extends Model
{
    use HasFactory;
  
    protected $primaryKey = 'academic_member_id';
    protected $table = 'academic_members';

    protected $fillable = [
        'membership_id',
        'organization_id',
        'course_id',
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'contact',
        'student_number',
        'email',
        'gender',
        'date_of_birth',
        'year_and_section',
        'membership_status',
        'address',
        'control_number'
        
    ];

    }
