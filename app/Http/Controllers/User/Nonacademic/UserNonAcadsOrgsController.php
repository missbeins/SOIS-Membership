<?php

namespace App\Http\Controllers\User\Nonacademic;

use App\Http\Controllers\Controller;
use App\Models\Non_Academic_Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserNonAcadsOrgsController extends Controller
{
    public function index(){

        $user_id = Auth::user()->user_id;
        $organizations = Non_Academic_Members::join('non_academic_membership','non_academic_membership.non_academic_membership_id','=','non_academic_members.membership_id')
                    ->join('organizations','organizations.organization_id','=','non_academic_membership.organization_id')
                    ->where('user_id',$user_id)
                    ->where('membership_status','paid')->get();
       
        return view('users.Nonacademic.nonacademic-organizations',compact('organizations'));
    }
}
