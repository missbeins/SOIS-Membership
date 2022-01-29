<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Non_Academic_Members extends Model
{
    use HasFactory;
    protected $primaryKey = 'non_academic_member_id';
    protected $table = 'non_academic_members';

    protected $fillable = [
        'user_id',
        'organization_id',
        'course',
        'first_name',
        'middle_name',
        'last_name',
        'contact',
        'student_number',
        'email',
        'gender',
        'address',
        'date_of_birth',
        'year_and_section',
        'subscription',
        'approval_status',
        
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
