<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcadsMembership_Messages extends Model
{
    use HasFactory;
    protected $primaryKey = 'message_id';
    protected $table = 'acadsmembership_messages';
    protected $fillable = ['message','academic_member_id'];
}
