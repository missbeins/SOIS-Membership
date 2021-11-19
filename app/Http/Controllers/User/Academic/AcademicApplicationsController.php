<?php

namespace App\Http\Controllers\User\Academic;

use App\Http\Controllers\Controller;
use App\Models\academic_application;
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

        return view('users.user.Academic.application');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
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
            
        $applicationList = Academic_Membership::all();
        
        $applicationExist = false;
    
        foreach ($applicationList as $application) {
    
            if ($application->user_id == $user_id  && $application->organization_id == $data['organization']) {
                
                $applicationExist = true;                 
                return redirect()->back()->with('error', 'Application denied! There is an existing application.');
            }        
        } 
        if ($applicationExist == false) {
            $non_academic_membership = Academic_Membership::create([
    
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\academic_application  $academic_application
     * @return \Illuminate\Http\Response
     */
    public function show(academic_application $academic_application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\academic_application  $academic_application
     * @return \Illuminate\Http\Response
     */
    public function edit(academic_application $academic_application)
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
    public function update(Request $request, academic_application $academic_application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\academic_application  $academic_application
     * @return \Illuminate\Http\Response
     */
    public function destroy(academic_application $academic_application)
    {
        //
    }
}
