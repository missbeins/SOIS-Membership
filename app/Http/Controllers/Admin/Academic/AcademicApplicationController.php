<?php

namespace App\Http\Controllers\Admin\Academic;

use App\Http\Controllers\Controller;
use App\Models\Academic_Members;
use App\Models\AcademicApplication;
use App\Models\Course;
use App\Models\Expected_Applicants;
use App\Models\Gender;
use Illuminate\Http\Request;
use App\Models\organizations;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AcademicApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $expected_applicants = Expected_Applicants::paginate(5, ['*'], 'expected-applicants');
        $genders = Gender::all();
        $courses = Course::all();
        $acad_applications = AcademicApplication::join('academic_membership','academic_membership.academic_membership_id','=','academic_applications.membership_id')
                        ->join('organizations','organizations.organization_id','=','academic_membership.organization_id')
                        ->where('application_status','=','pending')
                        ->select()
                        ->paginate(5, ['*'], 'applicants');

        return view('admin.applications.applications', compact(['acad_applications','expected_applicants','courses','genders']));
    }
    public function expectedRegistrants(){
        $expected_applicants = Expected_Applicants::where('course_id',Auth::user()->course_id)
                            ->paginate(5, ['*'], 'expected-applicants');

        return view('admin.applications.expected-applicants', compact('expected_applicants'));
    }
    public function addNewRegistrant(Request $request){

        
        $request->validate([

            'first_name' => ['required','string'],
            'middle_name' => ['nullable','string'],
            'last_name' => ['required','string'],
            'student_number' => ['nullable','string'],
            'course_id' => ['nullable','integer'],
            'suffix' =>['nullable','string']
        ]);

        Expected_Applicants::create([
            'first_name' => $request['first_name'],
            'middle_name' => $request['middle_name'],
            'last_name' => $request['last_name'],
            'student_number' => $request['student_number'],
            'suffix' => $request['suffix'],
            'course_id' => $request['course_id'],
        ]);
        return redirect()->back()->with('success','Registrant successfully added!');

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function accept(Request $request, $id )
    {   
        
        $request->validate([
            'application_id' =>['required'],
            'membership_id' =>['required'],
            'organization_id' =>['required'],
            'user_id' =>['required'],
            'control_number' => ['required'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'student_number' => ['required', 'string', 'max:50'],
            'year_and_section' => ['required', 'string', 'max:255'],
            'course_id' => ['required', 'string'],
            'mobile_number' => ['required', 'string'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'string'], 
            'address' => ['required', 'string'], 
        ]);
        
        Academic_Members::create([
            'membership_id' => $request['membership_id'],
            'organization_id' => $request['organization_id'],
            'course_id' => $request['course_id'],
            'user_id' => $request['user_id'],
            'control_number' => $request['control_number'],
            'first_name' => $request['first_name'],
            'middle_name' => $request['middle_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'student_number' =>$request['student_number'],
            'year_and_section' => $request['year_and_section'],
            'course_id' => $request['course_id'],
            'contact' => $request['mobile_number'],
            'address' => $request['address'],
            'gender' => $request['gender'],
            'date_of_birth' => $request['date_of_birth'],          
        ]);
       
        AcademicApplication::where('application_id',$id)->update ([
           'application_status' => 'approved'
        ]);
        
        return redirect()->back()->with('success','Application approved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function decline(Request $request, $id)
    {   
        
        $request->validate([
            'application_id' =>['required'],
            'membership_id' =>['required'],
            'organization_id' =>['required'],
            'user_id' =>['required'],
            'control_number' => ['required'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'student_number' => ['required', 'string', 'max:50'],
            'year_and_section' => ['required', 'string', 'max:255'],
            'course_id' => ['required', 'string'],
            'mobile_number' => ['required', 'string'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'string'], 
            'address' => ['required', 'string'], 
        ]);
        
        Academic_Members::create([
            'membership_id' => $request['membership_id'],
            'organization_id' => $request['organization_id'],
            'course_id' => $request['course_id'],
            'user_id' => $request['user_id'],
            'control_number' => $request['control_number'],
            'first_name' => $request['first_name'],
            'middle_name' => $request['middle_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'student_number' =>$request['student_number'],
            'year_and_section' => $request['year_and_section'],
            'course_id' => $request['course_id'],
            'contact' => $request['mobile_number'],
            'address' => $request['address'],
            'gender' => $request['gender'],
            'date_of_birth' => $request['date_of_birth'],          
        ]);
       
        AcademicApplication::where('application_id',$id)->update ([
           'application_status' => 'declined'
        ]);
        
        
        return redirect()->back()->with('error', ' Application Declined!');
    }
   
}

