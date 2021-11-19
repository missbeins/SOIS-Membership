<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organizations;
use App\Models\Non_Academic_Membership;
use App\Models\Academic_Membership;
use Illuminate\Support\Facades\Auth;

class UserApplicationsController extends Controller
{
    public function index(){
       
        //$user_org_id = auth::user()->course['organization_id'];
        $academic_memberships = Academic_Membership::join('organizations','organizations.organization_id','=','academic_membership.organization_id')
                            ->where('academic_membership.organization_id',auth::user()->course['organization_id'])
                            ->get();

        $non_academic_memberships = Non_Academic_Membership::join('organizations','organizations.organization_id','=','non_academic_membership.organization_id')
                            ->get();
                            
        $academic_organization = Organizations::join('academic_membership','academic_membership.organization_id','=','organizations.organization_id')   
                            ->where('academic_membership.status','=','Open')
                            ->get();
        $non_academic_organization = Organizations::join('non_academic_membership','non_academic_membership.organization_id','=','organizations.organization_id')    
                            ->where('non_academic_membership.status','=','Open')
                            ->get();                
        // dd($available_organizations);
        return view('users.user.user-application', compact(['academic_memberships', 'non_academic_memberships','non_academic_organization','academic_organization']));
        
    }

    
}
