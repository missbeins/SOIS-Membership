<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Declined_Nonaapplications extends Model
{
    use HasFactory;
    protected $table = 'declined_nonaapplications';
    protected $primaryKey = 'declined_nonaapp_id';
    protected $fillable = ['reason','application_id'];
}
