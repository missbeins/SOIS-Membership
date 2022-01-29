<?php

namespace App\Http\Controllers\User\Nonacademic;

use App\Http\Controllers\Controller;
use App\Models\Non_Academic_Applications;
use App\Models\Non_Academic_Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserNonAcademicApplicationController extends Controller
{
    public function showForm()
    {
        $nonacademic_memberships = Non_Academic_Membership::where('registration_status','=','Open')->orWhere('registration_status','=','open')
            ->get();
            
        return view('users.Nonacademic.application',compact('nonacademic_memberships'));
           
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        $user_id = Auth::user()->user_id;
        $data = $request->validate([

            'membership_id' => ['required','string'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'suffix' => ['nullable', 'string'],
            'email' => ['required','string', 'email', 'max:255'],
            'student_number' => ['required', 'string'],
            'year_and_section' => ['required','string', 'max:255'],
            'course' => ['required', 'string'],
            'mobile_number' => ['required', 'string'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'string'], 
            'address' => ['required','string'],
            
        ]);

        $nonacademic_memberships = Non_Academic_Membership::where('non_academic_membership_id',$request->membership_id)
                            ->where('registration_status','=','Open')
                            ->where('registration_status','=','open')
                            ->first();

        $user_id = Auth::user()->user_id;

        $applicationList = Non_Academic_Applications::all();
        
        $applicationExist = false;
    
        foreach ($applicationList as $application) {
    
            if ($application->user_id == $user_id && $data['membership_id'] == $application->membership_id) {
                
                $applicationExist = true;                 
                return redirect()->back()->with('error', 'Application denied! There is an existing application.');
            }        
        } 
        if ($applicationExist == false) {
            
            Non_Academic_Applications::create([
        
                'user_id' => $user_id,
                'organization_id' => $nonacademic_memberships->organization_id,
                'membership_id' => $data['membership_id'],
                'course_id' => $data['course'],
                'first_name' => $data['first_name'],
                'middle_name' => $data['middle_name'],
                'last_name' => $data['last_name'],
                'suffix' => $data['suffix'],
                'student_number' => $data['student_number'],
                'email' => $data['email'],
                'gender' => $data['gender'],
                'date_of_birth' => $data['date_of_birth'],
                'application_status' => 'pending',
                'year_and_section' => $data['year_and_section'],
                'contact' => $data['mobile_number'],
                'address' => $data['address'],
                
            ]);
            $request->session()->flash('success','Application Success!');

            return redirect(route('membership.user.nonacademic.my-applications'));
           
        }       
          
    }
}
