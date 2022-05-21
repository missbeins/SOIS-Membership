<?php

namespace App\Http\Controllers\Admin\Nonacademic;

use App\Http\Controllers\Controller;
use App\Models\Non_Academic_Members;
use App\Models\Non_Academic_Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class NonAcademicPaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(){
        
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
            ->orderBy('non_academic_member_id','DESC')
            // ->paginate(7);
            ->get();
        $nonacademic_memberships = Non_Academic_Membership::where('organization_id',$organizationID)
            ->get();
        return view('admin.subscription.nonacademic.subscription',compact(['paidmembers','nonacademic_memberships']));
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

                $nonacademic_memberships = Non_Academic_Membership::where('organization_id',$organizationID)
                    ->get();
                $query = $_GET['query'];
                $paidmembers = Non_Academic_Members::join('non_academic_membership','non_academic_membership.non_academic_membership_id','=','non_academic_members.membership_id')        
                    ->where('non_academic_members.membership_id','LIKE','%'.$query.'%')
                    ->where('non_academic_members.membership_status','=','paid')
                    ->where('non_academic_members.organization_id',$organizationID)
                    ->orderBy('non_academic_member_id','DESC')
                    ->get();
                // dd($paidmembers);
                return view('admin.subscription.nonacademic.filterPayments',compact(['paidmembers','nonacademic_memberships']));
            
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
    public function show($id)
    {
        //
    }

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
}
