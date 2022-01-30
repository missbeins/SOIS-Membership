<?php

namespace App\Http\Controllers\Admin\Nonacademic;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Declined_Aapplications;
use App\Models\Declined_NAapplications;
use App\Models\Declined_Nonaapplications;
use App\Models\Gender;
use App\Models\Non_Academic_Applications;
use App\Models\Non_Academic_Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class NonAcademicApplicationsController extends Controller
{
    /**
    * @param Array $roles, String $role
    * Function to search for a role under 'role' column in $roles Array 
    * Return Array Key if found, False if not
    * @return True: Integer, False: Boolean
    */ 
   private function hasRole($roles, $role)
   {
       return array_search($role, array_column($roles, 'role'));
   }
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index(){
       if (Gate::allows('is-admin')) {
           // Pluck all User Roles
           $userRoleCollection = Auth::user()->roles;

           // Remap User Roles into array with Organization ID
           $userRoles = array();
           foreach ($userRoleCollection as $role) 
           {
               array_push($userRoles, ['role' => $role->role, 'organization_id' => $role->pivot->organization_id]);
           }

           // If User has MEMBERSHIP Admin role...
       
           $memberRoleKey = $this->hasRole($userRoles,'User');
           // Get the Organization from which the user is Membeship Admin
           $userRoleKey = $this->hasRole($userRoles, 'Membership Admin');
           $organizationID = $userRoles[$userRoleKey]['organization_id'];
       
           $genders = Gender::all();
           $courses = Course::all();
           $nonacad_applications = Non_Academic_Applications::join('non_academic_membership','non_academic_membership.non_academic_membership_id','=','non_academic_applications.membership_id')
                           ->join('organizations','organizations.organization_id','=','non_academic_membership.organization_id')
                           ->where('application_status','=','pending')
                           ->sortable()
                           ->paginate(5, ['*'], 'applicants');

           return view('admin.applications.nonacademic.applications', compact(['nonacad_applications','courses','genders']));
       }
   }
 
   public function declinedApplications(){
       if (Gate::allows('is-admin')) {
           // Pluck all User Roles
           $userRoleCollection = Auth::user()->roles;

           // Remap User Roles into array with Organization ID
           $userRoles = array();
           foreach ($userRoleCollection as $role) 
           {
               array_push($userRoles, ['role' => $role->role, 'organization_id' => $role->pivot->organization_id]);
           }

           // If User has MEMBERSHIP Admin role...
       
           $memberRoleKey = $this->hasRole($userRoles,'User');
           // Get the Organization from which the user is Membeship Admin
           $userRoleKey = $this->hasRole($userRoles, 'Membership Admin');
           $organizationID = $userRoles[$userRoleKey]['organization_id'];
       
           $genders = Gender::all();
           $courses = Course::all();
           $nonacad_applications = Non_Academic_Applications::join('non_academic_membership','non_academic_membership.non_academic_membership_id','=','non_academic_applications.membership_id')
                           ->join('organizations','organizations.organization_id','=','non_academic_membership.organization_id')
                           ->join('declined_naapplications','declined_naapplications.application_id','=','non_academic_applications.application_id')
                           ->where('application_status','=','declined')
                           ->sortable()
                           ->paginate(5, ['*'], 'applicants');
           

           return view('admin.applications.nonacademic.declined-applications', compact(['nonacad_applications','courses','genders']));
       }else{
           abort(403);
       }
   }
 
   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function accept(Request $request, $id, $orgId ){
       if (Gate::allows('is-admin')) {
           // Pluck all User Roles
           $userRoleCollection = Auth::user()->roles;

           // Remap User Roles into array with Organization ID
           $userRoles = array();
           foreach ($userRoleCollection as $role) 
           {
               array_push($userRoles, ['role' => $role->role, 'organization_id' => $role->pivot->organization_id]);
           }

           // If User has MEMBERSHIP Admin role...
       
           $memberRoleKey = $this->hasRole($userRoles,'User');
           // Get the Organization from which the user is Membeship Admin
           $userRoleKey = $this->hasRole($userRoles, 'Membership Admin');
           $organizationID = $userRoles[$userRoleKey]['organization_id'];
           
           
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
           if ($orgId == $organizationID) {
               Non_Academic_Members::create([
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
           
               Non_Academic_Applications::where('application_id',$id)->update ([
               'application_status' => 'approved'
               ]);
               
               return redirect()->back()->with('success','Application approved!');
           } else {
               abort(403);
           }
       }else{
           abort(403);
      }
   }
   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function decline(Request $request, $id,  $orgId){   
       
       if (Gate::allows('is-admin')) {
           // Pluck all User Roles
           $userRoleCollection = Auth::user()->roles;

           // Remap User Roles into array with Organization ID
           $userRoles = array();
           foreach ($userRoleCollection as $role) 
           {
               array_push($userRoles, ['role' => $role->role, 'organization_id' => $role->pivot->organization_id]);
           }

           // If User has MEMBERSHIP Admin role...
       
           $memberRoleKey = $this->hasRole($userRoles,'User');
           // Get the Organization from which the user is Membeship Admin
           $userRoleKey = $this->hasRole($userRoles, 'Membership Admin');
           $organizationID = $userRoles[$userRoleKey]['organization_id'];
       
           
           $request->validate([
               'application_id' =>['required'],
               'membership_id' =>['required'],
               'organization_id' =>['required'],
               'user_id' =>['required'],
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
               'reason' => ['required','string'],
           ]);
           if ($orgId == $organizationID) {
               
               Non_Academic_Applications::where('application_id',$id)->update ([
               'application_status' => 'declined'
               ]);

               Declined_Nonaapplications::create([
                   'reason' => $request['reason'],
                   'application_id' => $id,
               ]);
               
               return redirect()->back()->with('error', ' Application Declined!');
           }else{
               abort(403);
           }
       }else{
           abort(403);
       }
   }
  
}
