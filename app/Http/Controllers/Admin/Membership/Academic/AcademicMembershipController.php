<?php

namespace App\Http\Controllers\Admin\Membership\Academic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Academic_Membership;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AcademicMembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data = $request->validate([
            'semester' => ['required'],
            'membership_fee' => ['required','integer'],
            'school_year' => ['required'],
            'membership_start_date' => ['required','date'],
            'membership_end_date' => ['required', 'date','after:membership_start_date'],
            'status' => ['required','string'],
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
            'status' =>  $data['status'],
            'registration_start_date' =>  $data['registration_start_date'],
            'registration_end_date' =>  $data['registration_end_date'],           
        
        ]);

        $request->session()->flash('success','Successfully added new membership!');
        return redirect()->back();
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
    public function update(Request $request, $id)
    {
        $adminOrg = Auth::user()->course['organization_id'];

        $data = $request->validate([
            'semester' => ['required'],
            'membership_fee' => ['required','integer'],
            'school_year' => ['required'],
            'membership_start_date' => ['required','date'],
            'membership_end_date' => ['required', 'date','after:membership_start_date'],
            'status' => ['required','string'],
            'registration_status' => ['required','string'],
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
            'status' =>  $data['status'],
            'registration_start_date' =>  $data['registration_start_date'],
            'registration_end_date' =>  $data['registration_end_date'],
        
        ]);

        $request->session()->flash('success','Membership updated!');
        return redirect(route('membership.admin.users.index'));
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
