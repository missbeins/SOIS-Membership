<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership_Messages extends Model
{
    use HasFactory;

    protected $primaryKey = 'message_id';
    protected $table = 'membership_messages';
    protected $fillable = ['message','user_id','organization_id'];
}
