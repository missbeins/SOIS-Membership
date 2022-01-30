<?php

namespace App\Http\Controllers\User\Nonacademic;

use App\Http\Controllers\Controller;
use App\Models\Non_Academic_Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NonAcademicSubscriptionsController extends Controller
{
    public function index(){
        
        $user_id = Auth::user()->user_id;
        $organizations = Non_Academic_Members::join('academic_membership','academic_membership.academic_membership_id','=','academic_members.membership_id')
                    ->join('organizations','organizations.organization_id','=','academic_membership.organization_id')
                    ->where('user_id',$user_id)
                    ->where('membership_status','unpaid')->get();
       return view('users.nonacademic.user-subscription',compact('organizations'));
    }
}
