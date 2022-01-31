<?php

namespace App\Http\Controllers\User\Academic;

use App\Http\Controllers\Controller;
use App\Models\AcademicApplication;
use App\Models\Academic_Membership;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserAcademicApplicationsController extends Controller
{
    public function showForm()
    {
        $academic_memberships = Academic_Membership::where('registration_status','=','Open')
            ->where('am_status','=','Active')
            ->get();
            
        return view('users.Academic.application',compact('academic_memberships'));
           
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

        $academic_memberships = Academic_Membership::where('academic_membership_id',$request->membership_id)
                            ->where('registration_status','=','Open')
                            ->where('registration_status','=','open')
                            ->first();

        $user_id = Auth::user()->user_id;

        $applicationList = AcademicApplication::all();
        
        $applicationExist = false;
    
        foreach ($applicationList as $application) {
    
            if ($application->user_id == $user_id && $data['membership_id'] == $application->membership_id) {
                
                $applicationExist = true;                 
                return redirect()->back()->with('error', 'Application denied! There is an existing application.');
            }        
        } 
        if ($applicationExist == false) {
            
            AcademicApplication::create([
        
                'user_id' => $user_id,
                'organization_id' => $academic_memberships->organization_id,
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

            return redirect(route('membership.user.academic.my-applications'));
           
        }       
          
    }

}
