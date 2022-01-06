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
use App\Models\AcademicApplication;
use App\Models\Expected_Applicants;
use App\Models\Permission;
use PhpParser\Node\Stmt\If_;

class UserController extends Controller
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
 
         // If User has AR President Admin role...
        
         $memberRoleKey = $this->hasRole($userRoles,'User');
         // Get the Organization from which the user is Membeship Admin
         $userRoleKey = $this->hasRole($userRoles, 'Membership Admin');
         $organizationID = $userRoles[$userRoleKey]['organization_id'];
       
        if(Gate::denies('logged-in')){

            return redirect()->back();
        }

        if(Gate::allows('is-admin')){
            
            $admin_org_id = Auth::user()->course['organization_id'];
            $admin_course = Auth::user()->course_id;
            $members = Academic_Members::all()
                ->where('membership_status','=','paid')
                ->where('course_id',$admin_course)
                ->count();
            
            $unpaid_members = Academic_Members::all()
                ->where('membership_status','=','unpaid')
                ->where('course_id',$admin_course)
                ->count();
                
            $applications = AcademicApplication::all()
                
                ->where('application_status','=','pending')
                ->where('course_id',$admin_course)
                ->count();
            
            $users = User::join('courses','courses.course_id','=','users.course_id')
                                ->join('role_user','role_user.user_id','=','users.user_id')
                                ->join('organizations','organizations.organization_id','=','courses.organization_id')
                                ->where('courses.organization_id',$organizationID)
                                ->where('role_user.role_id', 8)
                                ->paginate(5);
            $academic_memberships = Academic_Membership::where('organization_id','=',Auth::user()->course['organization_id'])
                                ->select()
                                ->paginate(1, ['*'], 'academic-memberships');

            // $academic_membership = Academic_Membership::all()
            //                     ->where('')
            return view('admin.users.index',compact([
                'members',
                'unpaid_members',
                'applications',
                'users',
                'academic_memberships'
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
            'middle_name' => ['string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'student_number' => ['required', 'string', 'max:50', 'unique:users'],
            'year_and_section' => ['required', 'string', 'max:255'],
            'course_id' => ['required', 'string'],
            'mobile_number' => ['required', 'string'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'string'], 
            'address' => ['required', 'string'], 
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
            'address' => $data['address'],
            'date_of_birth' => $data['date_of_birth']
        ]);
        
        $user->roles()->attach(2);

        $user->permissions()->attach([28,30,31]);
        // $user->permissions()->attach(30);
        // $user->permissions()->attach(31);
        
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
        abort_if(! User::where('user_id', Auth::user()->user_id)->exists(), 403);
       
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
