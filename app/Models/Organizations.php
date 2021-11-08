<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

class Organizations extends Model
{
    use HasFactory;
    protected $guarded=[ ];
    protected $primaryKey='organizations_id';
    protected $table='organizations';
    protected $fillable = [
       'organization_name',
       'organization_acronym',
       'organization_type_id',
    ];

    public function courses()
    {
        return $this->belongsTo(Courses::class, 'course_id');
    }
}
