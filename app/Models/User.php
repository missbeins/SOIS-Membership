<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Non_Academic_Membership;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $primaryKey='user_id';
    protected $table='users';
    protected $fillable = [

        'first_name',
        'middle_name',
        'last_name',
        'mobile_number',
        'student_number',
        'course_id',
        'year_and_section',
        'email',
        'password',
        'date_of_birth',
        'suffix',
        'address',
        'status',
        'gender_id'
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function setPasswordAttribute($password){

    //     $this->attributes['password'] = Hash::make($password);
    // }
    
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_user', 'user_id', 'permission_id');
    }
   /**
     * The roles that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id')->withPivot('organization_id');
    }
    
    public function hasAnyRole(String $role){

        return null !== $this->roles()->where('role', $role)->first();
    }
    // public function getOrgType(String $type){

    //     return null !== $this->roles()->where('organization_type_id', $type)->first();
    // }
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    /**
     * Get the non_academic_membership that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function non_academic_membership()
    {
        return $this->belongsTo(Non_Academic_Membership::class, 'non-academic_membership_id');
    }
    
}
