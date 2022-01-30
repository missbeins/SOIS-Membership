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
       
        //$user_org_id = auth::user()->course['organization_id'];
        // $nonacademic_memberships = Non_Academic_Membership::join('organizations','organizations.organization_id','=','non_academic_membership.organization_id')
        //                     ->where('non_academic_membership.organization_id',auth::user()->course['organization_id'])
        //                     ->paginate(5);

        $nonacademic_memberships = Non_Academic_Membership::join('organizations','organizations.organization_id','=','non_academic_membership.organization_id')
                            ->sortable()
                            ->paginate(5);
                            
        // $nonacademic_organization = Organizations::join('academic_membership','academic_membership.organization_id','=','organizations.organization_id')   
        //                     ->where('academic_membership.am_status','=','Open')
        //                     ->get();
        $nonacademic_organization = Organizations::join('non_academic_membership','non_academic_membership.organization_id','=','organizations.organization_id')    
                            ->where('non_academic_membership.nam_status','=','Open')
                            ->get(); 
        $application_statuses = Non_Academic_Applications::join('non_academic_membership','non_academic_membership.non_academic_membership_id','=','non_academic_applications.membership_id')
                            ->join('organizations','organizations.organization_id','=','non_academic_membership.organization_id')
                            ->where('user_id',Auth::user()->user_id)
                            ->sortable()
                            ->paginate(10);
                                     
        //  dd($application_statuses);
        return view('users.Nonacademic.user-application', compact([
            'nonacademic_memberships',
            'nonacademic_organization',
            'application_statuses'
        ]));
        
    }
}
