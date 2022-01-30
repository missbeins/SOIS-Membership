<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Declined_Nonaapplications extends Model
{
    use HasFactory;
    use Sortable;
    protected $table = 'declined_naapplications';
    protected $primaryKey = 'declined_nonaapp_id';
    protected $fillable = ['reason','application_id'];
    protected $sortable = ['reason','application_id','created_at'];
}
