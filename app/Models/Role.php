<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    use HasFactory;
    protected $primaryKey='role_id';
    protected $table='roles';
    
   /**
     * The roles that belong to the Role
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id')->withPivot('organization_id');
    }
    public function permissions()
    {
        return $this->belongsToMany(User::class, 'permission_role', 'role_id', 'permission_id');
    }
      
}
