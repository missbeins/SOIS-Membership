<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Expected_Applicants;
use App\Models\Academic_Membership;
use App\Models\Course;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class InformationVerificationController extends Controller
{
    public function index(){
        
        return view('auth.information-verify');

    }

    public function verifyInformation(Request $request){
        
        $data = $request->validate([

            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'student_number' => ['required', 'string', 'max:50'],
           
        ]);

        $applicantExist = false;
        $expected_applicants = Expected_Applicants::all();
        
        foreach($expected_applicants as $applicant){

            if($applicant['first_name'] == $data['first_name'] && $applicant['middle_name'] == $data['middle_name'] && $applicant['last_name'] == $data['last_name'] && $applicant['student_number'] == $data['student_number']){
              
                $applicantExist = true;
                            
            }
           
        }
        if($applicantExist==true){

            return view('guest.register',
            [
    
                'courses'=>Course::all(),
                'roles' => Role::all()
            
             ]);
           }
        else{

            $request->session()->flash('error','Verification failed!');
            return redirect()->back();
        }

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

            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'student_number' => ['required', 'string', 'max:50', 'unique:users'],
            'year_and_section' => ['required', 'string', 'max:255'],
            'course_id' => ['required', 'string'],
            'mobile_number' => ['required', 'string'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'string'], 
           
        ]);

        $user = User::create([
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'student_number' =>$data['student_number'],
            'year_and_section' => $data['year_and_section'],
            'course_id' => $data['course_id'],
            'mobile_number' => $data['mobile_number'],
        ]);

        $academic_membership = Academic_Membership::create([

            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'student_number' => $data['student_number'],
            'email' => $data['email'],
            'date_of_birth' => $data['date_of_birth'],
            'subscription' => 'unpaid',
            'gender' => $data['gender'],
            'approval_status' => 'approved',
            'year_and_section' => $data['year_and_section'],
            'course_id' => $data['course_id'],
            'mobile_number' => $data['mobile_number'],
        ]);
        
        $user->roles()->attach(2);
        $request->session()->flash('success','Successfully added new user!');
        
        return redirect(route('login'));

    }
    
}