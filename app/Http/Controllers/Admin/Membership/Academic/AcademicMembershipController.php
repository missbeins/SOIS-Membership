<?php

namespace App\Http\Controllers\Admin\Membership\Academic;

use App\Http\Controllers\Controller;
use App\Models\Academic_Members;
use Illuminate\Http\Request;
use App\Models\Academic_Membership;
use App\Models\AcademicApplication;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class AcademicMembershipController extends Controller
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
                
            $applications = AcademicApplication::all()
                
                ->where('application_status','=','pending')
                ->where('course_id',$admin_course)
                ->count();
            
            $academic_memberships = Academic_Membership::where('organization_id','=',Auth::user()->course['organization_id'])
                                ->paginate(1, ['*'], 'academic-memberships');
            return view('admin.memberships.academic.memberships',compact([
                'applications',
                'academic_memberships'
             ]));
        }else{
            abort(403);
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
        $adminOrg = Auth::user()->course['organization_id'];
        $registration_status = ['Open','Closed'];
        $semesters = ['1st Semester','2nd Semester'];
        $am_status = ['Active','Ended'];
        $data = $request->validate([
            'semester' => ['required',Rule::in($semesters)],
            'membership_fee' => ['required','integer'],
            'school_year' => ['required'],
            'membership_start_date' => ['required','date'],
            'membership_end_date' => ['required', 'date','after:membership_start_date'],
            'status' => ['required','string',Rule::in($am_status)],
            'registration_status' => ['required',Rule::in($registration_status)],
            'registration_start_date' => ['required','date'],
            'registration_end_date' => ['required', 'date','after:registration_start_date'],
            
        ]);
        
        $academic_membership = Academic_Membership::create([
            'organization_id' => $adminOrg,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
            'semester' => $data['semester'],
            'membership_fee' => $data['membership_fee'],
            'school_year' =>  $data['school_year'],
            'membership_start_date' =>  $data['membership_start_date'],
            'membership_end_date' =>  $data['membership_end_date'], 
            'registration_status' =>  $data['registration_status'],
            'am_status' =>  $data['status'],
            'registration_start_date' =>  $data['registration_start_date'],
            'registration_end_date' =>  $data['registration_end_date'],           
        
        ]);

        $request->session()->flash('success','Successfully added new membership!');
        return redirect(route('membership.admin.academicmembership.index'));
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
        $academic_membership=Academic_Membership::findorfail($id);
        
        if($academic_membership){

            return view('admin.memberships.academic.editMembership', compact('academic_membership'));
        
        }else{
            return back()->with('Error', "Record Not Found");
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
        $adminOrg = Auth::user()->course['organization_id'];
        $registration_status = ['Open','Closed'];
        $semesters = ['1st Semester','2nd Semester'];
        $am_status = ['Active','Ended'];
        $data = $request->validate([
            'semester' => ['required',Rule::in($semesters)],
            'membership_fee' => ['required','integer'],
            'school_year' => ['required'],
            'membership_start_date' => ['required','date'],
            'membership_end_date' => ['required', 'date','after:membership_start_date'],
            'status' => ['required','string',Rule::in($am_status)],
            'registration_status' => ['required',Rule::in($registration_status)],
            'registration_start_date' => ['required','date'],
            'registration_end_date' => ['required', 'date','after:registration_start_date'],
            
        ]);
        
        $academic_membership = Academic_Membership::where('academic_membership_id',$id)->update([
                                      
            'organization_id' => $adminOrg,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
            'semester' => $data['semester'],
            'membership_fee' => $data['membership_fee'],
            'school_year' =>  $data['school_year'],
            'membership_start_date' =>  $data['membership_start_date'],
            'membership_end_date' =>  $data['membership_end_date'], 
            'registration_status' =>  $data['registration_status'],
            'am_status' =>  $data['status'],
            'registration_start_date' =>  $data['registration_start_date'],
            'registration_end_date' =>  $data['registration_end_date'],
        
        ]);

        $request->session()->flash('success','Membership updated!');
        return redirect(route('membership.admin.academicmembership.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $academic_membership = Academic_Membership::find($id);
        $academic_membership->delete();

        $request->session()->flash('success','Membership deleted!');

        return redirect()->back();
    }
}
