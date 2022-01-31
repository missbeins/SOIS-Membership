<?php

namespace App\Http\Controllers\User\Academic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organizations;
use App\Models\Non_Academic_Membership;
use App\Models\Academic_Membership;
use App\Models\AcademicApplication;
use Illuminate\Support\Facades\Auth;

class UserApplicationsController extends Controller
{
    public function index(){
       
        $academic_memberships = Academic_Membership::join('organizations','organizations.organization_id','=','academic_membership.organization_id')
                            ->where('academic_membership.organization_id',auth::user()->course['organization_id'])
                            ->where('academic_membership.am_status','=','Active')
                            ->where('academic_membership.registration_status','=','Open')
                            ->sortable(['academic_membership_id','DESC'])
                            ->paginate(5);

      
        // $academic_organization = Organizations::join('academic_membership','academic_membership.organization_id','=','organizations.organization_id')   
        //                     ->where('academic_membership.am_status','=','Active')
        //                     ->where('academic_membership.registration_status','=','Open')
        //                     ->get();
        
        $application_statuses = AcademicApplication::join('academic_membership','academic_membership.academic_membership_id','=','academic_applications.membership_id')
                            ->join('organizations','organizations.organization_id','=','academic_membership.organization_id')
                            ->where('user_id',Auth::user()->user_id)
                            ->sortable(['application_id','DESC'])
                            ->paginate(10);

        return view('users.Academic.user-application', compact([
            'academic_memberships',
            'application_statuses'
        ]));
        
    }

    
}
