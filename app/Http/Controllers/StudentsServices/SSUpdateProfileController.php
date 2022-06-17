<?php

namespace App\Http\Controllers\StudentsServices;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class SSUpdateProfileController extends Controller
{
    
    public function updateProfile(Request $request, $id){

        if(Gate::allows('is-studentservices')){
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
                'mobile_number' => ['required', 'string'], 
                'gender_id' =>['required','integer']
            ]);

            User::where('user_id',$id)->update([
                'first_name' => $data['first_name'],
                'middle_name' => $data['middle_name'],
                'last_name' => $data['last_name'],
                'suffix' => $data['suffix'],
                'email' => $data['email'],  
                'gender_id' => $data['gender_id'],
                'mobile_number' => $data['mobile_number'],
                
            ]);

            
            $request->session()->flash('success','Successfully update profile!');
            
            return redirect()->back();
        }else{
            abort(403);
        }
    }
}
