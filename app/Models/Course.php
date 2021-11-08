<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Organizations;

class Course extends Model
{
    use HasFactory;
    protected $guarded=[ ];
    protected $primaryKey='course_id';
    protected $table='courses';
    protected $fillable = [
       'course_name',
       'course_id',
       'course_acronym'
    ];
    public function user()
    {
        return $this->hasMany(User::class, 'user_id');
    }
    public function organizations(){

        return $this->hasOne(Organizations::class, 'organization_id');
    }
}
