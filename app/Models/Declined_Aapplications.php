<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Declined_Aapplications extends Model
{
    use HasFactory;
    use Sortable;
    protected $table = 'declined_aapplications';
    protected $primaryKey = 'declined_aapp_id';
    protected $fillable = ['reason','application_id'];
    protected $sortable = ['declined_aapp_id','reason','application_id','created_at'];
}
