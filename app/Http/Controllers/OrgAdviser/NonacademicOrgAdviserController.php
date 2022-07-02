<?php

namespace App\Http\Controllers\NonAcademicOrgAdviserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Organizations;
use App\Models\User;
use App\Models\Gender;
use App\Models\Non_Academic_Members;
use App\Models\Non_Academic_Membership;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use PDF;

class NonacademicOrgAdviserController extends Controller
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

     // If User has Adviser role...

     $memberRoleKey = $this->hasRole($userRoles,'User');
     // Get the Organization from which the user is Membeship adviser
     $userRoleKey = $this->hasRole($userRoles, 'Adviser');
     $organizationID = $userRoles[$userRoleKey]['organization_id'];

    if(Gate::denies('logged-in')){

        return redirect()->back();
    }

    if(Gate::allows('is-adviser')){
         $membershipCount = Non_Academic_Membership::where('organization_id',$organizationID)->count();
         $activeMembersCount = Non_Academic_Membership::join('non_academic_members','non_academic_members.membership_id','=','non_academic_membership.non_academic_membership_id')
                             ->where('non_academic_membership.organization_id',$organizationID)
                             ->where('am_status','=','Active')
                             ->count();
         $non_academic_memberships = Non_Academic_Membership::where('organization_id',$organizationID)
                         ->orderBy('non_academic_membership_id','DESC')
                         //    ->paginate(3, ['*'], 'academic-memberships');
                         ->get();
         // dd($non_academic_memberships);
         $year_and_sections = Non_Academic_Membership::join('non_academic_members','non_academic_members.membership_id','=','non_academic_membership.non_academic_membership_id')
                            ->where('non_academic_membership.organization_id',$organizationID)
                            ->select('non_academic_members.year_and_section')
                            ->get();

         $yearLevels = collect([]);

         foreach ($year_and_sections as  $year_and_section) {
         $yearLevels->push($year_and_section);
         }
         $newyearLevelscollection = $yearLevels->unique('year_and_section');
         return view('adviser.nonacademic.index',compact([
             'non_academic_memberships',
             'membershipCount',
             'activeMembersCount',
             'newyearLevelscollection'
         ]));
    }else{
        abort(403);
    }
 }
 public function showMembershipDetails($id){

     if(Gate::allows('is-adviser')){
         abort_if(! Non_Academic_Membership::where('non_academic_membership_id', $id)->exists(), 404);
         $non_academic_membership = Non_Academic_Membership::where('non_academic_membership_id', $id)->first();
         return view('adviser.nonacademic.membership-details',compact('non_academic_membership'));
     }else{
         abort(403);
     }
 }
 public function showMembers($id){
     if(Gate::allows('is-adviser')){
         abort_if(! Non_Academic_Membership::where('non_academic_membership_id', $id)->exists(), 404);
         $members = Non_Academic_Members::join('non_academic_membership','non_academic_membership.non_academic_membership_id','=','non_academic_members.membership_id')
                 ->where('non_academic_membership_id', $id)
                 // ->paginate(7);
                 ->get();
         return view('adviser.nonacademic.membership-members',compact('members'));
     }else{
         abort(403);
     }
 }
 public function showMembersDetails($id){
     if(Gate::allows('is-adviser')){
         abort_if(! Non_Academic_Members::where('non_academic_members_id', $id)->exists(), 404);
         $member_detail = Non_Academic_Members::where('non_academic_members_id', $id)->first();
         $courses = Course::all();
         return view('adviser.nonacademic.member-details',compact('member_detail','courses'));
     }else{
         abort(403);
     }
 }
 public function generateMembershipPDF($id, Request $request){
     // Pluck all User Roles
     $userRoleCollection = Auth::user()->roles;

     // Remap User Roles into array with Organization ID
     $userRoles = array();
     foreach ($userRoleCollection as $role)
     {
         array_push($userRoles, ['role' => $role->role, 'organization_id' => $role->pivot->organization_id]);
     }

     // If User has Adviser role...

     $memberRoleKey = $this->hasRole($userRoles,'User');
     // Get the Organization from which the user is Membeship adviser
     $userRoleKey = $this->hasRole($userRoles, 'Adviser');
     $organizationID = $userRoles[$userRoleKey]['organization_id'];
     // $id = $request->membership_id;
     // dd($request);
     abort_if(! Non_Academic_Membership::where('non_academic_membership_id', $id)->exists(), 404);

     $non_acad_membership = Non_Academic_Membership::where('non_academic_membership_id', $id)->first();
     $members = Non_Academic_Members::join('non_academic_membership','non_academic_membership.non_academic_membership_id','=','non_academic_members.membership_id')
                 ->join('courses','courses.course_id','=','academic_members.course_id')
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
     $pdf = PDF::loadView('adviser.nonacademic.pdf-file', compact([
        'non_acad_membership',
        'members',
        'membersCount',
        'gender',
        'organization'
     ]))->setPaper('legal', 'landscape');

     return $pdf->stream('Memberships.pdf');
 }

 public function generateMembershipPDFperYearLevel( Request $request){
     // Pluck all User Roles
     $userRoleCollection = Auth::user()->roles;

     // Remap User Roles into array with Organization ID
     $userRoles = array();
     foreach ($userRoleCollection as $role)
     {
         array_push($userRoles, ['role' => $role->role, 'organization_id' => $role->pivot->organization_id]);
     }

     // If User has Adviser role...

     $memberRoleKey = $this->hasRole($userRoles,'User');
     // Get the Organization from which the user is Membeship adviser
     $userRoleKey = $this->hasRole($userRoles, 'Adviser');
     $organizationID = $userRoles[$userRoleKey]['organization_id'];
     $id = $request->membership_id;
     $yearLevel = $request->yearLevel;
     // dd($id);
     abort_if(! Non_Academic_Membership::where('non_academic_membership_id', $id)->exists(), 404);

     $non_acad_membership = Non_Academic_Membership::where('non_academic_membership_id', $id)->first();

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
     $pdf = PDF::loadView('adviser.nonacademic.pdf-file', compact([
        'non_acad_membership',
        'members',
        'membersCount',
        'gender',
        'organization'
     ]))->setPaper('legal', 'landscape');

     return $pdf->stream('Memberships.pdf');
 }
    /**
     * Display a listing of the members.
     *
     * @return \Illuminate\Http\Response
     */
    public function orgMembers()
    {

        // Pluck all User Roles
        $userRoleCollection = Auth::user()->roles;

        // Remap User Roles into array with Organization ID
        $userRoles = array();
        foreach ($userRoleCollection as $role)
        {
            array_push($userRoles, ['role' => $role->role, 'organization_id' => $role->pivot->organization_id]);
        }

        // Get the Organization from which the user is Adviser
        $userRoleKey = $this->hasRole($userRoles, 'Adviser');
        $organizationID = $userRoles[$userRoleKey]['organization_id'];

         if (Gate::allows('is-adviser')) {
            $paidmembers = Non_Academic_Members::join('non_academic_membership','non_academic_membership.non_academic_membership_id','=','non_academic_members.membership_id')
                ->where('non_academic_members.membership_status','=','paid')
                ->where('non_academic_members.organization_id',$organizationID)
                ->orderBy('non_academic_members_id','DESC')
                // ->paginate(5);
                ->get();
            $non_academic_memberships = Non_Academic_Membership::where('organization_id',$organizationID)
                ->get();
            return view('adviser.nonacademic.members',compact(['paidmembers','non_academic_memberships']));
        } else {
           abort(403);
       }
    }

    public function filterMembers(Request $request){
        if (Gate::allows('is-adviser')) {
             // Pluck all User Roles
             $userRoleCollection = Auth::user()->roles;

             // Remap User Roles into array with Organization ID
             $userRoles = array();
             foreach ($userRoleCollection as $role)
             {
                 array_push($userRoles, ['role' => $role->role, 'organization_id' => $role->pivot->organization_id]);
             }

             // If User has AR President adviser role...


             // Get the Organization from which the user is AR President adviser
             $userRoleKey = $this->hasRole($userRoles, 'Adviser');
             $organizationID = $userRoles[$userRoleKey]['organization_id'];

           // dd(isset($_GET['query']));
            if(isset($_GET['query'])){

                $non_academic_memberships = Non_Academic_Membership::where('organization_id',$organizationID)
                    ->get();
                $query = $_GET['query'];
                $paidmembers = Non_Academic_Members::join('non_academic_membership','non_academic_membership.non_academic_membership_id','=','non_academic_members.membership_id')
                    ->where('membership_id','LIKE','%'.$query.'%')
                    ->where('membership_status','=','paid')
                    ->where('non_academic_members.organization_id',$organizationID)
                    ->orderBy('non_academic_members_id','DESC')
                    ->get();
                return view('adviser.nonacademic.filter',compact(['paidmembers','non_academic_memberships']));

            }else{
                return redirect()->back();
            }
        }else{
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $orgId)
    {
        if (Gate::allows('is-adviser')) {
             // Pluck all User Roles
             $userRoleCollection = Auth::user()->roles;

             // Remap User Roles into array with Organization ID
             $userRoles = array();
             foreach ($userRoleCollection as $role)
             {
                 array_push($userRoles, ['role' => $role->role, 'organization_id' => $role->pivot->organization_id]);
             }

             // Get the Organization from which the user is Adviser
             $userRoleKey = $this->hasRole($userRoles, 'Adviser');
             $organizationID = $userRoles[$userRoleKey]['organization_id'];
            if ($orgId == $organizationID) {
                abort_if(! Non_Academic_Members::where('non_academic_members_id', $id)->exists(), 403);
                $organizations = Organizations::all();
                $courses = Course::all();
                $member_detail = Non_Academic_Members::find($id);
                return view('adviser.nonacademic.show',compact([
                    'member_detail',
                    'organizations',
                    'courses'
                ]));
            } else {
                abort(403);
            }
        }else{
            abort(403);
        }
    }
    public function paymentDetails(){

     // Pluck all User Roles
     $userRoleCollection = Auth::user()->roles;

     // Remap User Roles into array with Organization ID
     $userRoles = array();
     foreach ($userRoleCollection as $role)
     {
         array_push($userRoles, ['role' => $role->role, 'organization_id' => $role->pivot->organization_id]);
     }

     // Get the Organization from which the user is AR President Admin
     $userRoleKey = $this->hasRole($userRoles, 'Membership Admin');
     $organizationID = $userRoles[$userRoleKey]['organization_id'];


     $paidmembers = Non_Academic_Members::join('non_academic_membership','non_academic_membership.non_academic_membership_id','=','non_academic_members.membership_id')
         ->where('non_academic_members.organization_id',$organizationID)
         ->orderBy('control_number','DESC')
         // ->paginate(10);
         ->get();
     $non_academic_memberships = Non_Academic_Membership::where('organization_id',$organizationID)
         ->get();
     return view('adviser.nonacademic.subscription',compact(['paidmembers','non_academic_memberships']));
 }
 public function filterPayments(Request $request){
     if (Gate::allows('is-admin')) {
         if(isset($_GET['query'])){
             // Pluck all User Roles
             $userRoleCollection = Auth::user()->roles;

             // Remap User Roles into array with Organization ID
             $userRoles = array();
             foreach ($userRoleCollection as $role)
             {
                 array_push($userRoles, ['role' => $role->role, 'organization_id' => $role->pivot->organization_id]);
             }

             // Get the Organization from which the user is AR President Admin
             $userRoleKey = $this->hasRole($userRoles, 'Membership Admin');
             $organizationID = $userRoles[$userRoleKey]['organization_id'];

             $non_academic_memberships = Non_Academic_Membership::where('organization_id',$organizationID)
                 ->get();
             $query = $_GET['query'];
             $paidmembers = Non_Academic_Members::join('non_academic_membership','non_academic_membership.non_academic_membership_id','=','non_academic_members.membership_id')
                 ->where('non_academic_members.membership_id','LIKE','%'.$query.'%')
                 ->where('non_academic_members.membership_status','=','paid')
                 ->where('non_academic_members.organization_id',$organizationID)
                 ->orderBy('control_number','DESC')
                 ->get();
             // dd($paidmembers);
             return view('adviser.nonacademic.filterPayments',compact(['paidmembers','non_academic_memberships']));

         }else{
             return redirect()->back();

         }
     }else{
         abort(403);
     }
 }
}
