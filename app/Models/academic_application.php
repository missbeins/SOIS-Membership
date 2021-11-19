<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class academic_application extends Model
{
    use HasFactory;
    protected $table = 'academic_applications';
    protected $primaryKey ='application_id';
    protected $fillable = [
        'user_id',
        'organization_id',
        'membership_id',
        'student_number',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'gender',
        'year_and_section',
        'date_of_birth',
        'contact',
        'address',
        'application_status'
    ];
}
