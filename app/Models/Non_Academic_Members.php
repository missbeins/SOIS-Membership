<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Non_Academic_Members extends Model
{
    use HasFactory;
    use Sortable;
    protected $primaryKey = 'non_academic_member_id';
    protected $table = 'non_academic_members';

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
    protected $sortable = [
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
        'control_number',
        'created_at'
        
    ];

    /**
     * Get the user associated with the Non_Academic_Membership
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }
}
