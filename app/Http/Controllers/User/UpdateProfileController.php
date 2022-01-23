<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;


class UpdateProfileController extends Controller
{
    public function updateProfile(Request $request, $id){
       
        // Pluck all User Roles
        $userRoleCollection = Auth::user()->roles;

        // Remap User Roles into array with Organization ID
        $userRoles = array();
        foreach ($userRoleCollection as $role) 
        {
            array_push($userRoles, ['role' => $role->role, 'organization_id' => $role->pivot->organization_id]);
        }

        // If User has GPOA Admin role...
       
        $memberRoleKey = $this->hasRole($userRoles,'User');

        // Get the Organization from which the user is GPOA Admin
        // $userRoleKey = $this->hasRole($userRoles, 'GPOA Admin');
        $organizationID = $userRoles[$memberRoleKey]['organization_id']; 

        if(Gate::allows('is-student')){
            $data = $request->validate([

                'first_name' => ['required', 'string', 'max:255'],
                'middle_name' => ['nullable','string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'suffix' =>['nullable','string','max:10'],
                'email' => [
                    'required', 
                    'string', 
                    'email', 
                    'max:255',
                    Rule::unique('users')->ignore($id,'user_id')],
                'student_number' => [
                    'required', 
                    'string', 
                    'max:50', 
                    Rule::unique('users')->ignore($id,'user_id')],
                'year_and_section' => ['required', 'string'],
                'course_id' => ['required', 'integer'],
                'mobile_number' => ['required', 'string'], 
                'gender_id' =>['required','integer']
            ]);

            $user = User::where('user_id',$id)->update([
                'first_name' => $data['first_name'],
                'middle_name' => $data['middle_name'],
                'last_name' => $data['last_name'],
                'suffix' => $data['suffix'],
                'email' => $data['email'],  
                'student_number' => $data['student_number'],
                'course_id' => $data['course_id'],
                'gender_id' => $data['gender_id'],
                'year_and_section' => $data['year_and_section'],
                'mobile_number' => $data['mobile_number'],
                
            ]);

            
            $request->session()->flash('success','Successfully update profile!');
            
            return redirect(route('user.profile'));
        }else{
            abort(403);
        }
    }
}
