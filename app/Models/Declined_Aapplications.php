<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Declined_Aapplications extends Model
{
    use HasFactory;
    protected $table = 'declined_aapplications';
    protected $primaryKey = 'declined_aapp_id';
    protected $fillable = ['reason','application_id'];
}
