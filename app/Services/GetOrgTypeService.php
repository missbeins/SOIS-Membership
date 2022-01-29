<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GetOrgTypeService
{
    /**
     * Service to get Organization ID of User.
     * Returns Organization ID on success.
     * @return Integer
     */

    public function getOrganizationID()
    {
        // Pluck all User Roles
        $userRoleCollection = Auth::user()->roles;

        // Remap User Roles into array with Organization ID
        $userRoles = array();
        foreach ($userRoleCollection as $role) 
        {
            array_push($userRoles, ['role' => $role->role, 'organization_id' => $role->pivot->organization_id]);
        }
        
        // Get Organization ID from role "AR Officer Admin"
        $userRoleKey = array_search('Membership Admin', array_column($userRoles, 'role'));

        $organizationID = $userRoles[$userRoleKey]['organization_id'];
        $organizationTypeId = DB::table('organization_types')
                        ->join('organizations','organizations.organization_type_id','=','organization_types.organization_type_id')
                        ->where('organizations.organization_id', $organizationID)
                        ->first();
        return $organizationTypeId;

    }
}
