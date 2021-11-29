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
  
    public function users()
    {
    	return $this->hasMany(User::class, 'course_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organizations::class, 'organization_id');
    }
}
