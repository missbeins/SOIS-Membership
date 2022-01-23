<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Expected_Applicants;
use App\Models\Academic_Members;
use App\Models\Course;
use App\Models\Gender;
use App\Models\Organizations;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class InformationVerificationController extends Controller
{
    public function index(){
        
        return view('guest.register', [
            'genders'=> Gender::all(),
            'courses'=>Course::all(),
            'roles' => Role::all()
        
         ]);

    }

    public function verifyInformation(Request $request){
        
        $data = $request->validate([
            
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => [ 'nullable','max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'suffix' => ['nullable'],
            'address' => ['required','string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'student_number' => ['nullable', 'string', 'max:50', 'unique:users'],
            'year_and_section' => ['nullable', 'string', 'max:255'],
            'course_id' => ['nullable', 'string'],
            'mobile_number' => ['required', 'string'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'string'], 
            
           
        ]);
           
        $applicantExist = false;
        $expected_applicants = Expected_Applicants::all();
        
        foreach($expected_applicants as $applicant){

            if($applicant['first_name'] == $data['first_name'] && $applicant['middle_name'] == $data['middle_name'] && $applicant['last_name'] == $data['last_name'] && $applicant['suffix'] == $data['suffix'] && $applicant['student_number'] == $data['student_number']){
              
                $applicantExist = true;
                            
            }
           
        }
        if($applicantExist==true){

            $user = User::create([
                'first_name' => $data['first_name'],
                'middle_name' => $data['middle_name'],
                'last_name' => $data['last_name'],
                'suffix' => $data['suffix'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'student_number' =>$data['student_number'],
                'year_and_section' => $data['year_and_section'],
                'course_id' => $data['course_id'],
                'mobile_number' => $data['mobile_number'],
                'address' => $data['address'],
                'gender_id' => $data['gender'],
                'date_of_birth' => $data['date_of_birth'],
                'status' => 1,
            ]);
            $course = Course::with('organization')->where('course_id', $data['course_id'])->first();
            $orgId = $course->organization->organization_id;

                           
    
            // $vendor->services()->syncWithPivotValues($service_id, ['area_id' => $area->id]);

            // $user->roles()->syncWithPivotValues(8, ['organization_id' => $organization->organization_id]);
            $user->roles()->attach(8, ['organization_id' => $orgId]);
            $user->permissions()->attach([28,30,31]);
            $request->session()->flash('success','Account Registered!');
        
            return redirect(route('login'));
        }

        else{

            $request->session()->flash('error','You are not expected to register, please contact your organization.');
            return redirect()->back();
        }

    }

    
   
    
}
