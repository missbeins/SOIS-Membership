<?php

namespace App\Http\Controllers\Admin\Academic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Membership;
use App\Models\organizations;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AcademicApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $adminid = Auth::user()->course->organization_id;

    //     $applications = DB::table('memberships')
    //     ->join('users','memberships.user_id','=','users.user_id')
    //     ->join('courses','users.course_id','=','courses.course_id')
    //     ->where('approval_Status','=','pending')
    //     ->where('courses.organization_id',$adminid)

    //     ->select('memberships.membership_id','memberships.organization_id','memberships.approval_status','users.first_name','users.middle_name','users.last_name','users.year_and_section','courses.course_name')
    //     ->get();
        
    //     return view('membership.applications.index',compact('applications'));
    // }
    public function index(){
        return view('admin.applications.applications');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organizations = organizations::all();
        return view('membership.applications.create',compact('organizations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){


        $data = $request->validate([
            'organization'=>'required'            
        ]);
        
        $applicationId = Auth::user()->user_id;
        
        $applicationList = membership::all();
        
        $applicationExist = false;

        foreach ($applicationList as $application) {

            if ($application->user_id == $applicationId  && $application->organization_id == $data['organization']) {
                
                $applicationExist = true;                 
                return redirect()->back()->with('message', 'Application denied!');
            }        
        } 
        if ($applicationExist == false) {
            Membership::create([
                'organization_id' =>$data['organization'] ,
                'user_id' => Auth::user()->user_id,
                'approval_status' => 'Pending',
                'subscription' => 'Unpaid'
            ]);

            return redirect()->back()->with('success', 'Application Succesful!');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $app_request = App_Request::find($id);
        // return view('membership.applications.edit', compact('app_request'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request )
    {
       
        $data = $request->validate([
            'requestId'=>'required',
            'orgId'=>'required' 

        ]);


        Membership::where('membership_id',$data['requestId'])->update ([
            'membership_id' => $data['requestId'],
            'organization_id' => $data['orgId'],
            'approval_status' => 'Approved'
        ]);
        
        return redirect()->back()->with('success','Application approved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $app_request = Membership::find($id);
        $app_request->delete();
        return redirect()->back()->with('success', ' Application Declined!');
    }
}

