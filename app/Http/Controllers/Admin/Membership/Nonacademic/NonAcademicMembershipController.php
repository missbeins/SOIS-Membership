<?php

namespace App\Http\Controllers\Admin\Membership\Nonacademic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Academic_Membership;
use Illuminate\Support\Facades\Auth;

class NonAcademicMembershipController extends Controller
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
        
        $data = $request->validate([
            'semester' => ['required'],
            'membership_fee' => ['required','integer'],
            'school_year' => ['required'],
            'status' => ['required','string'],
            'start_date' => ['required','date'],
            'end_date' => ['required', 'date','after:start_date'],

            
        ]);
        
        $academic_membership = Academic_Membership::create([
            'organization_id' => $adminOrg,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
            'semester' => $data['semester'],
            'membership_fee' => $data['membership_fee'],
            'school_year' =>  $data['school_year'],
            'status' =>  $data['status'],
            'start_date' =>  $data['start_date'],
            'end_date' =>  $data['end_date'],           
        
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
            'status' => ['required','string'],
            'start_date' => ['required','date'],
            'end_date' => ['required', 'date','after:start_date'],

            
        ]);
        
        $academic_membership = Academic_Membership::where('academic_membership_id',$id)->update([
                                      
            'organization_id' => $adminOrg,
            'semester' => $data['semester'],
            'membership_fee' => $data['membership_fee'],
            'school_year' =>  $data['school_year'],
            'status' =>  $data['status'],
            'start_date' =>  $data['start_date'],
            'end_date' =>  $data['end_date'],           
        
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
