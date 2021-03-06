<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicApplication extends Model
{
    use HasFactory;
    protected $table = 'academic_applications';
    protected $primaryKey ='application_id';
    protected $fillable = [
        'user_id',
        'organization_id',
        'course_id',
        'membership_id',
        'student_number',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'email',
        'gender',
        'year_and_section',
        'date_of_birth',
        'contact',
        'address',
        'application_status'
    ];
   

}
