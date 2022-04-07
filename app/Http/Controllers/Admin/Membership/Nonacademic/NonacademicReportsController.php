<?php

namespace App\Http\Controllers\Admin\Membership\Nonacademic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Gender;
use App\Models\Non_Academic_Applications;
use App\Models\Non_Academic_Members;
use App\Models\Non_Academic_Membership;
use App\Models\Organizations;
use PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class NonacademicReportsController extends Controller
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
        // Get the Organization from which the user is Membership Admin
        $userRoleKey = $this->hasRole($userRoles, 'Membership Admin');
        $organizationID = $userRoles[$userRoleKey]['organization_id'];
      
       if(Gate::denies('logged-in')){

           return redirect()->back();
       }

       if(Gate::allows('is-admin')){
            $membershipCount = Non_Academic_Membership::where('organization_id',$organizationID)->count();
            $admin_course = Auth::user()->course_id;
            $activeMembersCount = Non_Academic_Membership::where('organization_id',$organizationID)->where('nam_status','=','Active')->count();
            $applications = Non_Academic_Applications::all()
               ->where('application_status','=','pending')
               ->where('organization_id',$organizationID)
               ->count();
           
            $nonacademic_memberships = Non_Academic_Membership::where('organization_id',$organizationID)
                               ->orderBy('non_academic_membership_id','DESC')
                               ->paginate(3, ['*'], 'non_academic-memberships');
            // dd($academic_memberships);
            $year_and_sections = Non_Academic_Membership::join('non_academic_members','non_academic_members.membership_id','=','non_academic_membership.non_academic_membership_id')
                               ->where('non_academic_members.organization_id',$organizationID)
                               ->select('non_academic_members.year_and_section')
                               ->get();
               
            $yearLevels = collect([]);
    
            foreach ($year_and_sections as  $year_and_section) {
            $yearLevels->push($year_and_section);
            }
            $newyearLevelscollection = $yearLevels->unique('year_and_section');
            return view('admin.reports.nonacademic.reports',compact([
                'applications',
                'nonacademic_memberships',
                'membershipCount',
                'activeMembersCount',
                'newyearLevelscollection'
            ]));
       }else{
           abort(403);
       }
    }
    public function showMembershipDetails($id){

        if(Gate::allows('is-admin')){
            abort_if(! Non_Academic_Membership::where('non_academic_membership_id', $id)->exists(), 404);
            $nonacademic_membership = Non_Academic_Membership::where('non_academic_membership_id', $id)->first();
            return view('admin.reports.nonacademic.membership-details',compact('nonacademic_membership'));
        }else{
            abort(403);
        }
    }
    public function showMembers($id){
        if(Gate::allows('is-admin')){
            abort_if(! Non_Academic_Members::where('non_academic_member_id', $id)->exists(), 404);
            $members = Non_Academic_Members::join('non_academic_membership','non_academic_membership.non_academic_membership_id','=','non_academic_members.membership_id')
                    ->where('non_academic_membership_id', $id)->paginate(7);
            return view('admin.reports.nonacademic.members',compact('members'));
        }else{
            abort(403);
        }
    }
    public function showMembersDetails($id){
        if(Gate::allows('is-admin')){
            abort_if(! Non_Academic_Members::where('non_academic_member_id', $id)->exists(), 404);
            $member_detail = Non_Academic_Members::where('non_academic_member_id', $id)->first();
            $courses = Course::all();
            return view('admin.reports.nonacademic.member-details',compact('member_detail','courses'));
        }else{
            abort(403);
        }
    }
    public function generateNonAcadMembershipPDF($id, Request $request){
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
        // Get the Organization from which the user is Membership Admin
        $userRoleKey = $this->hasRole($userRoles, 'Membership Admin');
        $organizationID = $userRoles[$userRoleKey]['organization_id'];
        // $id = $request->membership_id;
        // dd($request);
        abort_if(! Non_Academic_Membership::where('non_academic_membership_id', $id)->exists(), 404);

        $nonacad_membership = Non_Academic_Membership::where('non_academic_membership_id', $id)->first();
        $members = Non_Academic_Members::join('non_academic_membership','non_academic_membership.non_academic_membership_id','=','non_academic_members.membership_id')
                    ->join('courses','courses.course_id','=','non_academic_members.course_id')
                    ->where('non_academic_membership_id',$id)
                    ->get();
        $courses = Course::all();
        $gender = Gender::all();
        $organization = Organizations::join('non_academic_members','non_academic_members.organization_id','=','organizations.organization_id')
                    ->where('non_academic_members.membership_id',$id)
                    ->where('non_academic_members.organization_id',$organizationID)
                    ->first();
        $membersCount = Non_Academic_Members::join('non_academic_membership','non_academic_membership.non_academic_membership_id','=','non_academic_members.membership_id')
                    ->where('membership_id',$id)
                    ->count();
        // dd($organization);
        $pdf = PDF::loadView('admin.reports.nonacademic.nonacademic-pdf-file', compact([
           'nonacad_membership',
           'members',
           'membersCount',
           'gender',
           'organization'
        ]))->setPaper('legal', 'landscape');
        
        return $pdf->stream('Memberships.pdf');
    }

    public function generateNonAcadMembershipPDFperYearLevel( Request $request){
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
        abort_if(! Non_Academic_Membership::where('non_academic_membership_id', $id)->exists(), 404);

        $nonacad_membership = Non_Academic_Membership::where('non_academic_membership_id', $id)->first();

        $members = Non_Academic_Members::join('non_academic_membership','non_academic_membership.non_academic_membership_id','=','non_academic_members.membership_id')
                    ->join('courses','courses.course_id','=','non_academic_members.course_id')
                    ->where('non_academic_members.membership_id',$id)
                    ->where('year_and_section',$yearLevel)
                    ->get();
                    // dd($id);    
        $courses = Course::all();
        $gender = Gender::all();
        $organization = Organizations::join('non_academic_members','non_academic_members.organization_id','=','organizations.organization_id')
                    ->where('non_academic_members.membership_id',$id)
                    ->where('non_academic_members.organization_id',$organizationID)
                    ->first();
                    // dd($organization);

        $membersCount = Non_Academic_Members::join('non_academic_membership','non_academic_membership.non_academic_membership_id','=','non_academic_members.membership_id')
                    ->where('membership_id',$id)
                    ->count();
        $pdf = PDF::loadView('admin.reports.nonacademic.nonacademic-pdf-file', compact([
           'nonacad_membership',
           'members',
           'membersCount',
           'gender',
           'organization'
        ]))->setPaper('legal', 'landscape');
        
        return $pdf->stream('Memberships.pdf');
    }
}
