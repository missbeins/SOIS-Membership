<?php

namespace App\Http\Controllers\Admin\Academic;

use App\Http\Controllers\Controller;
use App\Models\Academic_Members;
use App\Models\Academic_Membership;
use App\Models\Membership_Messages;
use App\Models\Course;
use App\Models\Organizations;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;

class AcademicMembersController extends Controller
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
    public function index()
    {

        // Pluck all User Roles
        $userRoleCollection = Auth::user()->roles;

        // Remap User Roles into array with Organization ID
        $userRoles = array();
        foreach ($userRoleCollection as $role) 
        {
            array_push($userRoles, ['role' => $role->role, 'organization_id' => $role->pivot->organization_id]);
        }    
        
        // Get the Organization from which the user is Membership Admin
        $userRoleKey = $this->hasRole($userRoles, 'Membership Admin');
        $organizationID = $userRoles[$userRoleKey]['organization_id'];

       if (Gate::allows('is-admin')) {
            $paidmembers = Academic_Members::join('academic_membership','academic_membership.academic_membership_id','=','academic_members.membership_id')
                ->where('academic_members.membership_status','=','paid')
                ->where('academic_members.organization_id',$organizationID)
                ->orderBy('academic_member_id','DESC')
                // ->paginate(5);
                ->get();
            $academic_memberships = Academic_Membership::where('organization_id',$organizationID)
                ->get();
            return view('admin.members.academic.members',compact(['paidmembers','academic_memberships']));
        } else {
           abort(403);
       }
    }

    public function filterMembers(Request $request){
        if (Gate::allows('is-admin')) {
             // Pluck all User Roles
             $userRoleCollection = Auth::user()->roles;

             // Remap User Roles into array with Organization ID
             $userRoles = array();
             foreach ($userRoleCollection as $role) 
             {
                 array_push($userRoles, ['role' => $role->role, 'organization_id' => $role->pivot->organization_id]);
             }

             // If User has AR President Admin role...
         
             
             // Get the Organization from which the user is AR President Admin
             $userRoleKey = $this->hasRole($userRoles, 'Membership Admin');
             $organizationID = $userRoles[$userRoleKey]['organization_id'];

           // dd(isset($_GET['query']));
            if(isset($_GET['query'])){

                $academic_memberships = Academic_Membership::where('organization_id',$organizationID)
                    ->get();
                $query = $_GET['query'];
                $paidmembers = Academic_Members::join('academic_membership','academic_membership.academic_membership_id','=','academic_members.membership_id')        
                    ->where('membership_id','LIKE','%'.$query.'%')
                    ->where('membership_status','=','paid')
                    ->where('academic_members.organization_id',$organizationID)
                    ->orderBy('academic_member_id','DESC')
                    ->get();
                return view('admin.members.academic.filter',compact(['paidmembers','academic_memberships']));
            
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
        if (Gate::allows('is-admin')) {
             // Pluck all User Roles
             $userRoleCollection = Auth::user()->roles;

             // Remap User Roles into array with Organization ID
             $userRoles = array();
             foreach ($userRoleCollection as $role) 
             {
                 array_push($userRoles, ['role' => $role->role, 'organization_id' => $role->pivot->organization_id]);
             }
         
             // Get the Organization from which the user is Membership Admin
             $userRoleKey = $this->hasRole($userRoles, 'Membership Admin');
             $organizationID = $userRoles[$userRoleKey]['organization_id'];
            if ($orgId == $organizationID) {
                abort_if(! Academic_Members::where('academic_member_id', $id)->exists(), 403);
                $organizations = Organizations::all();
                $courses = Course::all();
                $member_detail = Academic_Members::find($id);
                return view('admin.members.academic.show',compact([
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
    /**
     * Show the form for messaging the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function messageMember(Request $request, $id)
    {   
        if (Gate::allows('is-admin')) {
            abort_if(! User::where('user_id', $id)->exists(), 403);

            $request->validate([
                'message_member' => ['required','string','max:255'],
                'user_id' =>['required','integer'],
                'organization_id' =>['required','integer']
            ]);

            Membership_Messages::create([
                'user_id' => $request['user_id'],
                'organization_id' => $request['organization_id'],
                'message' => $request['message_member']
            ]);

            return redirect(route('membership.admin.academic.academicmember.index'))->with('success','Message sent!');
        }else{
            abort(403);
        }

    }
}
