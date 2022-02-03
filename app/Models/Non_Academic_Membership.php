<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Non_Academic_Membership extends Model
{
    use HasFactory;
    protected $primaryKey = 'non_academic_membership_id';
    protected $table = 'non_academic_membership';

    protected $fillable = [
        
        'semester',
        'school_year',
        'registration_start_date',
        'registration_end_date',
        'membership_start_date',
        'membership_end_date',
        'organization_id',
        'membership_fee',
        'nam_status',
        'registration_status'
    ];
    
   
}
