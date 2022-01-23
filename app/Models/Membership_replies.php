<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership_replies extends Model
{
    use HasFactory;

    protected $table = 'membership_replies';
    protected $primaryKey = 'reply_id';
    protected $fillable = ['message_id','user_id','organization_id','reply'];
}
