<?php

namespace App\Http\Controllers\Admin\Membership\Academic;

use App\Http\Controllers\Controller;
use App\Models\Academic_Members;
use Illuminate\Http\Request;
use App\Models\Academic_Membership;
use App\Models\AcademicApplication;
use App\Models\Course;
use App\Models\Expected_Applicants;
use App\Models\Gender;
use App\Models\Organizations;
use PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class AcademicReportsController extends Controller
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
    public function index(){
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
      
       if(Gate::denies('logged-in')){

           return redirect()->back();
       }

       if(Gate::allows('is-admin')){
            $membershipCount = Academic_Membership::where('organization_id',$organizationID)->count();
            $accountRegistrantsCount = Expected_Applicants::where('organization_id',$organizationID)->count();
            $admin_course = Auth::user()->course_id;
            $activeMembersCount = Academic_Membership::where('organization_id',$organizationID)->where('am_status','=','Active')->count();
            $applications = AcademicApplication::all()
               ->where('application_status','=','pending')
               ->where('organization_id',$organizationID)
               ->count();
           
            $academic_memberships = Academic_Membership::where('organization_id',$organizationID)
                               ->orderBy('academic_membership_id','DESC')
                               ->paginate(3, ['*'], 'academic-memberships');
            // dd($academic_memberships);
            $year_and_sections = Academic_Membership::join('academic_members','academic_members.membership_id','=','academic_membership.academic_membership_id')
                               ->where('academic_membership.organization_id',$organizationID)
                               ->select('academic_members.year_and_section')
                               ->get();
               
            $yearLevels = collect([]);
    
            foreach ($year_and_sections as  $year_and_section) {
            $yearLevels->push($year_and_section);
            }
            $newyearLevelscollection = $yearLevels->unique('year_and_section');
            return view('admin.reports.academic.reports',compact([
                'applications',
                'academic_memberships',
                'membershipCount',
                'accountRegistrantsCount',
                'activeMembersCount',
                'newyearLevelscollection'
            ]));
       }else{
           abort(403);
       }
    }
    public function showMembershipDetails($id){

        if(Gate::allows('is-admin')){
            abort_if(! Academic_Membership::where('academic_membership_id', $id)->exists(), 404);
            $academic_membership = Academic_Membership::where('academic_membership_id', $id)->first();
            return view('admin.reports.academic.membership-details',compact('academic_membership'));
        }else{
            abort(403);
        }
    }
    public function showMembers($id){
        if(Gate::allows('is-admin')){
            abort_if(! Academic_Members::where('academic_member_id', $id)->exists(), 404);
            $members = Academic_Members::join('academic_membership','academic_membership.academic_membership_id','=','academic_members.membership_id')
                    ->where('academic_membership_id', $id)->paginate(7);
            return view('admin.reports.academic.members',compact('members'));
        }else{
            abort(403);
        }
    }
    public function showMembersDetails($id){
        if(Gate::allows('is-admin')){
            abort_if(! Academic_Members::where('academic_member_id', $id)->exists(), 404);
            $member_detail = Academic_Members::where('academic_member_id', $id)->first();
            $courses = Course::all();
            return view('admin.reports.academic.member-details',compact('member_detail','courses'));
        }else{
            abort(403);
        }
    }
    public function generateAcadMembershipPDF($id, Request $request){
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
        // $id = $request->membership_id;
        // dd($request);
        abort_if(! Academic_Membership::where('academic_membership_id', $id)->exists(), 404);

        $acad_membership = Academic_Membership::where('academic_membership_id', $id)->first();
        $members = Academic_Members::join('academic_membership','academic_membership.academic_membership_id','=','academic_members.membership_id')
                    ->join('courses','courses.course_id','=','academic_members.course_id')
                    ->where('academic_membership_id',$id)
                    ->get();
        $courses = Course::all();
        $gender = Gender::all();
        $organization = Organizations::join('academic_members','academic_members.organization_id','=','organizations.organization_id')
                    ->where('academic_members.membership_id',$id)
                    ->where('academic_members.organization_id',$organizationID)
                    ->first();
        $membersCount = Academic_Members::join('academic_membership','academic_membership.academic_membership_id','=','academic_members.membership_id')
                    ->where('membership_id',$id)
                    ->count();
        // dd($organization);
        $pdf = PDF::loadView('admin.reports.academic.academic-pdf-file', compact([
           'acad_membership',
           'members',
           'membersCount',
           'gender',
           'organization'
        ]))->setPaper('legal', 'landscape');
        
        return $pdf->stream('Memberships.pdf');
    }

    public function generateAcadMembershipPDFperYearLevel( Request $request){
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
        $id = $request->membership_id;
        $yearLevel = $request->yearLevel; 
        // dd($id);
        abort_if(! Academic_Membership::where('academic_membership_id', $id)->exists(), 404);

        $acad_membership = Academic_Membership::where('academic_membership_id', $id)->first();

        $members = Academic_Members::join('academic_membership','academic_membership.academic_membership_id','=','academic_members.membership_id')
                    ->join('courses','courses.course_id','=','academic_members.course_id')
                    ->where('academic_members.membership_id',$id)
                    ->where('year_and_section',$yearLevel)
                    ->get();
                    // dd($id);    
        $courses = Course::all();
        $gender = Gender::all();
        $organization = Organizations::join('academic_members','academic_members.organization_id','=','organizations.organization_id')
                    ->where('academic_members.membership_id',$id)
                    ->where('academic_members.organization_id',$organizationID)
                    ->first();
                    // dd($organization);

        $membersCount = Academic_Members::join('academic_membership','academic_membership.academic_membership_id','=','academic_members.membership_id')
                    ->where('membership_id',$id)
                    ->count();
        $pdf = PDF::loadView('admin.reports.academic.academic-pdf-file', compact([
           'acad_membership',
           'members',
           'membersCount',
           'gender',
           'organization'
        ]))->setPaper('legal', 'landscape');
        
        return $pdf->stream('Memberships.pdf');
    }
}