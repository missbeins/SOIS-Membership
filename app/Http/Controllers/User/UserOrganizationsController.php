<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organizations;
use App\Models\Academic_Membership;
use App\Models\Non_Academic_Membership;
use Illuminate\Support\Facades\Auth;

class UserOrganizationsController extends Controller
{
    public function index(){

        // $user_course = auth()->user()->course_id;
        // $userStudId = Auth::user()->student_number;
        // $user_id = Auth::user()->user_id;
        
        // $academic_membership = Academic_Membership::join('courses','courses.course_id','=','academic_membership.course_id')
        //     ->join('organizations','organizations.organization_id','=','courses.organization_id')
        //     ->where('student_number', $userStudId)
        //     ->get();
        // $non_academic_organizations = Non_Academic_Membership::all()
        //     ->where('user_id',$user_id)
        //     ->where('approval_status','=','approved');
       
        // return view('users.user.index',compact(['academic_membership','non_academic_organizations']));
        return view('users.user.index');
    }


    
}
