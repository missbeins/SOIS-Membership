<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Membership_Messages extends Model
{
    use HasFactory;
    use Sortable;
    protected $primaryKey = 'message_id';
    protected $table = 'membership_messages';
    protected $fillable = ['message','user_id','organization_id'];
    protected $sortable = ['message_id','message','user_id','organization_id','created_at'];
}
