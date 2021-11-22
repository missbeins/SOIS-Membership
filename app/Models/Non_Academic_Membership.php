<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Non_Academic_Membership extends Model
{
    use HasFactory;
    protected $primaryKey = 'non_academic_membership_id';
    protected $table = 'non_academic_membership';

    protected $fillable = [
        
        'semester',
        'school_year',
        'start_date',
        'end_date',
        'organization_id',
        'membership_fee',
        'status',
        'registration_status'
    ];
   
}
