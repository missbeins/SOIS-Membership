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
                            
        $available_organizations = Organizations::join('academic_membership','academic_membership.organization_id','=','organizations.organization_id')
                            // ->join('non_academic_membership','non_academic_membership.organization_id','=','organizations.organization_id')    
                            ->where('academic_membership.status','=','Open')
                            // ->where('non_academic_membership.status','=','Open')
                            ->get();
        // dd($available_organizations);
        return view('users.user.user-application', compact(['academic_memberships', 'non_academic_memberships','available_organizations']));
        
    }

   public function store(Request $request){
   
    $data = $request->validate([
        'user_id' => ['required','integer'],
        'first_name' => ['required', 'string', 'max:255'],
        'middle_name' => ['required', 'string', 'max:255'],
        'last_name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'student_number' => ['required', 'string', 'max:50'],
        'year_and_section' => ['required', 'string', 'max:255'],
        'course' => ['required', 'string'],
        'mobile_number' => ['required', 'string'],
        'date_of_birth' => ['required', 'date'],
        'gender' => ['required', 'string'], 
        'address' => ['required','string'],
        'organization' => ['required','integer']
    ]);

    $user_id = Auth::user()->user_id;
        
    $applicationList = Non_Academic_Membership::all();
    
    $applicationExist = false;

    foreach ($applicationList as $application) {

        if ($application->user_id == $user_id  && $application->organization_id == $data['organization']) {
            
            $applicationExist = true;                 
            return redirect()->back()->with('error', 'Application denied! There is an existing application.');
        }        
    } 
    if ($applicationExist == false) {
        $non_academic_membership = Non_Academic_Membership::create([

            'user_id' => $data['user_id'],
            'organization_id' => $data['organization'],
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'student_number' => $data['student_number'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'date_of_birth' => $data['date_of_birth'],
            'subscription' => 'unpaid',
            'approval_status' => 'pending',
            'year_and_section' => $data['year_and_section'],
            'course' => $data['course'],
            'contact' => $data['mobile_number'],
            'address' => $data['address'],
            
        ]);
    
        return redirect()->back();
    }      
   }
}
