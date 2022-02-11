<?php

namespace App\Http\Controllers\Admin\Membership\Nonacademic;

use App\Http\Controllers\Controller;
use App\Models\Non_Academic_Applications;
use App\Models\Non_Academic_Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class NonAcademicMembershipController extends Controller
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
 
         // If User has MEMBERSHIP Admin role...
        
         $memberRoleKey = $this->hasRole($userRoles,'User');
         // Get the Organization from which the user is Membeship Admin
         $userRoleKey = $this->hasRole($userRoles, 'Membership Admin');
         $organizationID = $userRoles[$userRoleKey]['organization_id'];
       
        if(Gate::denies('logged-in')){

            return redirect()->back();
        }

        if(Gate::allows('is-admin')){
            
            $admin_course = Auth::user()->course_id;
                
            $applications = Non_Academic_Applications::all()
                
                ->where('application_status','=','pending')
                ->where('organization_id',$organizationID)
                ->count();
            
            $nonacademic_memberships = Non_Academic_Membership::where('organization_id',$organizationID)
                                ->orderBy('non_academic_membership_id','DESC')
                                ->paginate(1, ['*'], 'nonacademic-memberships');
            return view('admin.memberships.nonacademic.memberships',compact([
                'applications',
                'nonacademic_memberships'
             ]));
        }else{
            abort(403);
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
        if(Gate::allows('is-admin')){
            $registration_status = ['Open','Closed'];
            $semesters = ['1st Semester','2nd Semester'];
            $nam_status = ['Active','Ended'];
            $data = $request->validate([
                'semester' => ['required',Rule::in($semesters)],
                'membership_fee' => ['required','integer'],
                'school_year' => ['required'],
                'membership_start_date' => ['required','date'],
                'membership_end_date' => ['required', 'date','after:membership_start_date'],
                'status' => ['required','string',Rule::in($nam_status)],
                'registration_status' => ['required',Rule::in($registration_status)],
                'registration_start_date' => ['required','date','after:membership_start_date','before:membership_end_date'],
                'registration_end_date' => ['required', 'date','after:registration_start_date','after:membership_start_date','before:membership_end_date'],
                 
            ]);
            $activeMembership = false;
            $isMembershipExisting = false;
            $getActiveMembership = Non_Academic_Membership::where('am_status','=','Active')->select('am_status')->get();
            $getExistingMemberships = Non_Academic_Membership::all();

            // dd($getExistingMemberships);
            foreach ($getActiveMembership as $membership) {
                if ($data['status'] == $membership->am_status) {
                    $activeMembership == true;       
                    return redirect()->back()->with('error', "There is a currently active membership. Please set it to 'ended' first.");
                }
            }
            foreach($getExistingMemberships as $existingmembership){
                if($data['semester'] == $existingmembership->semester && $data['school_year'] == $existingmembership->school_year){
                    $isMembershipExisting == true;       
                    return redirect()->back()->with('error', "Membership is already existing. Please recheck the school year and semster you input. ");

                }
            }
            if( $activeMembership == false && $isMembershipExisting == false) {
            
                $academic_membership = Non_Academic_Membership::create([
                    'organization_id' => $organizationID,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                    'semester' => $data['semester'],
                    'membership_fee' => $data['membership_fee'],
                    'school_year' =>  $data['school_year'],
                    'membership_start_date' =>  $data['membership_start_date'],
                    'membership_end_date' =>  $data['membership_end_date'], 
                    'registration_status' =>  $data['registration_status'],
                    'nam_status' =>  $data['status'],
                    'registration_start_date' =>  $data['registration_start_date'],
                    'registration_end_date' =>  $data['registration_end_date'],           
                
                ]);

                $request->session()->flash('success','Successfully added new membership!');
                return redirect(route('membership.admin.nonacademic.nonacademicmembership.index'));
            }
        }else{
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $orgId)
    {
        
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
       
        if(Gate::allows('is-admin')){
            if ($organizationID == $orgId){
                $nonacademic_membership=Non_Academic_Membership::findorfail($id);
                
                if($nonacademic_membership){

                    return view('admin.memberships.nonacademic.editMembership', compact('nonacademic_membership'));
                
                }else{
                    return back()->with('Error', "Record Not Found");
                }
            }else{
                abort(403);
            }
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
    public function update(Request $request, $id, $orgId)
    {    
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
        
        if(Gate::allows('is-admin')){
            if ($organizationID == $orgId) {
                $registration_status = ['Open','Closed'];
                $semesters = ['1st Semester','2nd Semester'];
                $nam_status = ['Active','Ended'];
                $data = $request->validate([
                    'semester' => ['required',Rule::in($semesters)],
                    'membership_fee' => ['required','integer'],
                    'school_year' => ['required'],
                    'membership_start_date' => ['required','date'],
                    'membership_end_date' => ['required', 'date','after:membership_start_date'],
                    'status' => ['required','string',Rule::in($nam_status)],
                    'registration_status' => ['required',Rule::in($registration_status)],
                    'registration_start_date' => ['required','date','after:membership_start_date','before:membership_end_date'],
                    'registration_end_date' => ['required', 'date','after:registration_start_date','after:membership_start_date','before:membership_end_date'],
                     
                ]);
                // $activeMembership = false;
                // $isMembershipExisting = false;
                // $getActiveMembership = Non_Academic_Membership::where('am_status','=','Active')->select('am_status')->get();
                // $getExistingMemberships = Non_Academic_Membership::all();
    
                // // dd($getExistingMemberships);
                // foreach ($getActiveMembership as $membership) {
                //     if ($data['status'] == $membership->am_status) {
                //         $activeMembership == true;       
                //         return redirect()->back()->with('error', "There is a currently active membership. Please set it to 'ended' first.");
                //     }
                // }
                // foreach($getExistingMemberships as $existingmembership){
                //     if($data['semester'] == $existingmembership->semester && $data['school_year'] == $existingmembership->school_year){
                //         $isMembershipExisting == true;       
                //         return redirect()->back()->with('error', "Membership is already existing. Please recheck the school year and semster you input. ");
    
                //     }
                // }
                // if( $activeMembership == false && $isMembershipExisting == false) {
            
                    if ($data['status'] == 'Ended') {
                        $academic_membership = Non_Academic_Membership::where('non_academic_membership_id',$id)->update([
                                                
                            'organization_id' => $organizationID,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                            'semester' => $data['semester'],
                            'membership_fee' => $data['membership_fee'],
                            'school_year' =>  $data['school_year'],
                            'membership_start_date' =>  $data['membership_start_date'],
                            'membership_end_date' =>  $data['membership_end_date'], 
                            'registration_status' =>  'Closed',
                            'nam_status' => 'Ended',
                            'registration_start_date' =>  $data['registration_start_date'],
                            'registration_end_date' =>  $data['registration_end_date'],
                        
                        ]);
    
                    } else {
                        $academic_membership = Non_Academic_Membership::where('non_academic_membership_id',$id)->update([
                                                
                            'organization_id' => $organizationID,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                            'semester' => $data['semester'],
                            'membership_fee' => $data['membership_fee'],
                            'school_year' =>  $data['school_year'],
                            'membership_start_date' =>  $data['membership_start_date'],
                            'membership_end_date' =>  $data['membership_end_date'], 
                            'registration_status' =>  $data['registration_status'],
                            'nam_status' =>  $data['status'],
                            'registration_start_date' =>  $data['registration_start_date'],
                            'registration_end_date' =>  $data['registration_end_date'],
                        
                        ]);
    
                    }
                    
                    
                    $request->session()->flash('success','Membership updated!');
                    return redirect(route('membership.admin.nonacademic.nonacademicmembership.index'));
                // }
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
        // public function destroy($id, Request $request)
        // {
        //     $academic_membership = Non_Academic_Membership::find($id);
        //     $academic_membership->delete();

        //     $request->session()->flash('success','Membership deleted!');

        //     return redirect()->back();
        // }
}
