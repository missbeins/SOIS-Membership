<?php

namespace App\Http\Controllers\Admin\Academic;

use App\Http\Controllers\Controller;
use App\Models\Academic_Members;
use App\Models\Academic_Membership;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class AcademicPaymentsController extends Controller
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

        
        $paidmembers = Academic_Members::join('academic_membership','academic_membership.academic_membership_id','=','academic_members.membership_id')
            ->where('academic_members.organization_id',$organizationID)
            ->orderBy('control_number','DESC')
            // ->paginate(10);
            ->get();
        $academic_memberships = Academic_Membership::where('organization_id',$organizationID)
            ->get();
        return view('admin.subscription.academic.subscription',compact(['paidmembers','academic_memberships']));
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

                $academic_memberships = Academic_Membership::where('organization_id',$organizationID)
                    ->get();
                $query = $_GET['query'];
                $paidmembers = Academic_Members::join('academic_membership','academic_membership.academic_membership_id','=','academic_members.membership_id')        
                    ->where('academic_members.membership_id','LIKE','%'.$query.'%')
                    ->where('academic_members.membership_status','=','paid')
                    ->where('academic_members.organization_id',$organizationID)
                    ->orderBy('control_number','DESC')
                    ->get();
                // dd($paidmembers);
                return view('admin.subscription.academic.filterPayments',compact(['paidmembers','academic_memberships']));
            
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
