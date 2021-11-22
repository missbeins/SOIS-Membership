<?php

namespace App\Http\Controllers\User\Academic;

use App\Http\Controllers\Controller;
use App\Models\AcademicApplication;
use App\Models\Academic_Membership;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AcademicApplicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showForm()
    {
        $academic_memberships = Academic_Membership::where('registration_status','=','Open')->where('registration_status','=','open')->get();
            
        return view('users.user.Academic.application',compact('academic_memberships'));
           
              
        
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
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required','string', 'email', 'max:255'],
            'student_number' => ['required', 'string'],
            'year_and_section' => ['required', 'string', 'max:255'],
            'course' => ['required', 'string'],
            'mobile_number' => ['required', 'string'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'string'], 
            'address' => ['required','string'],
            
        ]);

        $academic_memberships = Academic_Membership::where('registration_status','=','Open')->where('registration_status','=','open')->get();

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
                'membership_id' => $data['membership_id'],
                'course_id' => $data['course'],
                'first_name' => $data['first_name'],
                'middle_name' => $data['middle_name'],
                'last_name' => $data['last_name'],
                'student_number' => $data['student_number'],
                'email' => $data['email'],
                'gender' => $data['gender'],
                'date_of_birth' => $data['date_of_birth'],
                'application_status' => 'pending',
                'year_and_section' => $data['year_and_section'],
                'contact' => $data['mobile_number'],
                'address' => $data['address'],
                
            ]);
        
            return redirect(route('membership.user.my-applications'));
           
        }       
    
       
           
              
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\academic_application  $academic_application
     * @return \Illuminate\Http\Response
     */
    public function show(AcademicApplication $academic_application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\academic_application  $academic_application
     * @return \Illuminate\Http\Response
     */
    public function edit(AcademicApplication $academic_application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\academic_application  $academic_application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AcademicApplication $academic_application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\academic_application  $academic_application
     * @return \Illuminate\Http\Response
     */
    public function destroy(AcademicApplication $academic_application)
    {
        //
    }
}
