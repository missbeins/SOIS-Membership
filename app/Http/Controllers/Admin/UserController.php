<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Role;
use App\Models\Course;
use App\Models\Academic_Membership;
use App\Models\Academic_Members;
use Excel;
use App\Imports\ExpectedStudentsImport;
use PhpParser\Node\Stmt\If_;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
       
        if(Gate::denies('logged-in')){

            return redirect()->back();
        }

        if(Gate::allows('is-admin')){
            $admin_org_id = Auth::user()->course['organization_id'];
            $admin_course = Auth::user()->course_id;
            $members = Academic_Members::all()
                ->where('subscription','=','paid')
                ->where('approval_status','=','approved')
                ->where('course_id',$admin_course)
                ->count();
            
            $unpaid_members = Academic_Members::all()
                ->where('subscription','=','unpaid')
                ->where('approval_status','=','approved')
                ->where('course_id',$admin_course)
                ->count();
                
            $applications = Academic_Members::all()
                ->where('subscription','=','unpaid')
                ->where('approval_status','=','pending')
                ->where('course_id',$admin_course)
                ->count();
        
            $users = User::join('courses','courses.course_id','=','users.course_id')
                                ->join('role_user','role_user.user_user_id','=','users.user_id')
                                ->join('organizations','organizations.organization_id','=','courses.organization_id')
                                ->where('courses.organization_id',$admin_org_id)
                                ->where('role_user.role_role_id',2)
                                ->select()
                                ->paginate(5);

            // $academic_membership = Academic_Membership::all()
            //                     ->where('')
            return view('admin.users.index',compact([
                'members',
                'unpaid_members',
                'applications',
                'users'
        ]));
        }
        
        return view('users.user.index');
       
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create',
        [
        
            'courses'=>Course::all(),
            'roles' => Role::all()
        
         ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([

            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'student_number' => ['required', 'string', 'max:50', 'unique:users'],
            'year_and_section' => ['required', 'string', 'max:255'],
            'course_id' => ['required', 'string'],
            'mobile_number' => ['required', 'string'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'string'], 
        ]);

        $user = User::create([
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'student_number' =>$data['student_number'],
            'year_and_section' => $data['year_and_section'],
            'course_id' => $data['course_id'],
            'mobile_number' => $data['mobile_number'],
        ]);

        $academic_members = Academic_Members::create([

            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'student_number' => $data['student_number'],
            'email' => $data['email'],
            'date_of_birth' => $data['date_of_birth'],
            'subscription' => 'unpaid',
            'gender' => $data['gender'],
            'approval_status' => 'approved',
            'year_and_section' => $data['year_and_section'],
            'course_id' => $data['course_id'],
            'mobile_number' => $data['mobile_number'],
            // 'validity' => $data['validity'],
        ]);
        
        $user->roles()->attach(2);
        Password::sendResetLink($request->only(['email']));
        $request->session()->flash('success','Successfully added new user!');
        
        return redirect(route('membership.admin.users.index'));

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
        
        return view('admin.users.edit',
        [
            'courses'=>Course::all(),
            'user' => User::find($id),
            'roles' => Role::all(),

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
    
        $data = $request->validate([

            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 
                'string', 
                'email', 
                'max:255',
                Rule::unique('users')->ignore($user->user_id,'user_id')],
            'student_number' => [
                'required', 
                'string', 
                'max:50', 
                Rule::unique('users')->ignore($user->user_id,'user_id')],
            'year_and_section' => ['required', 'string', 'max:255'],
            'course_id' => ['required', 'string'],
            'mobile_number' => ['required', 'string'], 
        ]);

        $user->update([
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],  
            'student_number' => $data['student_number'],
            'course_id' => $data['course_id'],
            'year_and_section' => $data['year_and_section'],
            'mobile_number' => $data['mobile_number'],
            
        ]);

        
        $request->session()->flash('success','Successfully edited user!');
        
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
        $user = User::find($id);
        $user->delete();

        $request->session()->flash('success','Successfully deleted the user!');

        return redirect()->back()->with('success', ' User deleted!');
    }

    public function importStudents(Request $request){

        $request->validate([
            'file' => 'required|max:10000|mimes:xlsx,xls',
        ]);
        
        $path = $request->file('file');
        $import = new ExpectedStudentsImport;
        $import->import($path);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }
        //Excel::import(new ExpectedStudentsImport, $path);  
        //dd($import->failures());
        $request->session()->flash('success','Imported successfully!');    
        return redirect()->back();
    }
}
