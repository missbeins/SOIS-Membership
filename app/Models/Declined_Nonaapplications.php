<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Declined_Nonaapplications extends Model
{
    use HasFactory;
    protected $table = 'declined_naapplications';
    protected $primaryKey = 'declined_naapp_id';
    protected $fillable = ['reason','application_id'];
}
