<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academic_Membership extends Model
{
    use HasFactory;

    protected $primaryKey = 'academic_membership_id';
    protected $table = 'academic_membership';

    protected $fillable = [
        
        'semester',
        'school_year',
        'start_date',
        'end_date'
    ];

    
}
