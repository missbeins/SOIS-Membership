<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organizations;
use App\Models\Non_Academic_Membership;
use Illuminate\Support\Facades\Auth;

class UserApplicationsController extends Controller
{
    public function index(){
        
        return view('users.user.user-application');
        // $user_id = Auth::user()->user_id;
        // return view('users.user.user-application',[
           
        //     'applications' => Non_Academic_Membership::join('organizations','organizations.organization_id','=','non-academic_membership.organization_id')
        //                  ->where('user_id',$user_id)
        //                  ->get(),
        //     'non_academic_organization' => Organizations::all()->where('organization_type_id','=','2'),
        
        // ]);
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
