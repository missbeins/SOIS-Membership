<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Academic_Membership extends Model
{
    use HasFactory;
    use Sortable;

    protected $primaryKey = 'academic_membership_id';
    protected $table = 'academic_membership';

    protected $fillable = [
        
        'semester',
        'school_year',
        'registration_start_date',
        'registration_end_date',
        'membership_start_date',
        'membership_end_date',
        'organization_id',
        'membership_fee',
        'am_status',
        'registration_status'
    ];
    public $sortable = [ 
        'academic_membership_id',
        'semester',
        'school_year',
        'registration_start_date',
        'registration_end_date',
        'membership_start_date',
        'membership_end_date',
        'organization_id',
        'membership_fee',
        'am_status',
        'registration_status', 
        'created_at', 
        'updated_at'
    ];

    
}
