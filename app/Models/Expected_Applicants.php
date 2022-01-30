<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Expected_Applicants extends Model
{
    use HasFactory;
    use Sortable;
    protected $table = 'expected_applicants';

    protected $primaryKey = "expected_applicant_id";

    protected $fillable = [
        
        'organization_id',
        'first_name',
        'middle_name',
        'last_name',
        'student_number',
        'suffix',
       
    ];
    protected $sortable = [
        
        'organization_id',
        'first_name',
        'middle_name',
        'last_name',
        'student_number',
        'suffix',
        'created_at'
       
    ];
}
