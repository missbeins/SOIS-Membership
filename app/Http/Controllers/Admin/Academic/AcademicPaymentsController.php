<?php

namespace App\Http\Controllers\Admin\Academic;

use App\Http\Controllers\Controller;
use App\Models\Academic_Members;
use App\Models\Academic_Membership;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            ->paginate(10);
        $academic_memberships = Academic_Membership::where('organization_id',$organizationID)
            ->get();
        return view('admin.subscription.subscription',compact(['paidmembers','academic_memberships']));
    }
    public function filterPayments(Request $request){
        
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
                ->paginate(10);
            // dd($paidmembers);
            return view('admin.subscription.filterPayments',compact(['paidmembers','academic_memberships']));
        
        }else{
            return view('admin.subscription.filterPayments',compact(['paidmembers','academic_memberships']));

       }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //return view('admin.users.includes.subscription.modal');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $data = $request->validate([
           
            'subscription'=>'required' 

        ]);

        $subscription = Academic_Members::FindorFail($id);

        $subscription = Academic_Members::where('academic_member_id',$id)->update ([
            
            'membership_status' => 'paid'
        ]);
        
        return redirect()->back()->with('success','Membership payment settled!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
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
