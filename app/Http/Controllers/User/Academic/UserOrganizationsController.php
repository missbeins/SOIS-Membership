<?php

namespace App\Http\Controllers\User\Academic;

use App\Http\Controllers\Controller;
use App\Models\Academic_Members;
use Illuminate\Http\Request;
use App\Models\Organizations;
use Illuminate\Support\Facades\Auth;

class UserOrganizationsController extends Controller
{
    public function index(){

        $user_id = Auth::user()->user_id;
        $organizations = Academic_Members::join('academic_membership','academic_membership.academic_membership_id','=','academic_members.membership_id')
                    ->join('organizations','organizations.organization_id','=','academic_membership.organization_id')
                    ->where('user_id',$user_id)
                    ->where('membership_status','paid')->get();
       
        return view('users.academic.academic-organizations',compact('organizations'));
    }


    
}
