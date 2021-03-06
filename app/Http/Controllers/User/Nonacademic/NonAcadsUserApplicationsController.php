<?php

namespace App\Http\Controllers\User\Nonacademic;

use App\Http\Controllers\Controller;
use App\Models\Non_Academic_Applications;
use App\Models\Non_Academic_Membership;
use App\Models\Organizations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NonAcadsUserApplicationsController extends Controller
{
    public function index(){

        $nonacademic_memberships = Non_Academic_Membership::join('organizations','organizations.organization_id','=','non_academic_membership.organization_id')
                            ->orderBy('non_Academic_membership_id','DESC')
                            ->get();
                            
       
        $nonacademic_organization = Organizations::join('non_academic_membership','non_academic_membership.organization_id','=','organizations.organization_id')    
                            ->where('non_academic_membership.nam_status','=','Open')
                            ->get(); 
        $application_statuses = Non_Academic_Applications::join('non_academic_membership','non_academic_membership.non_academic_membership_id','=','non_academic_applications.membership_id')
                            ->join('organizations','organizations.organization_id','=','non_academic_membership.organization_id')
                            ->where('user_id',Auth::user()->user_id)
                            ->orderBy('application_id','DESC')
                            ->get();
                                     
        //  dd($application_statuses);
        return view('users.Nonacademic.user-application', compact([
            'nonacademic_memberships',
            'nonacademic_organization',
            'application_statuses'
        ]));
        
    }
}
