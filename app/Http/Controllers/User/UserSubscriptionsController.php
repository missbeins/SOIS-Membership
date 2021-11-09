<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Academic_Membership;
use Illuminate\Support\Facades\Auth;

class UserSubscriptionsController extends Controller
{
    public function index(){

        // $userFname = Auth::user()->first_name;
        // $userMname = Auth::user()->middle_name;
        // $userLname = Auth::user()->last_name;
        // $membership = Academic_Membership::join('courses','courses.course_id','=','academic_membership.course_id')
        // ->join('organizations','organizations.organization_id','=','courses.organization_id')
        // ->where('first_name', $userFname)
        // ->where('middle_name', $userMname)
        // ->where('last_name', $userLname)
        // ->get();
        // //dd($membership);
        // return view('users.user.user-subscription',compact('membership'));
        return view('users.user.user-subscription');
    }

    
}
