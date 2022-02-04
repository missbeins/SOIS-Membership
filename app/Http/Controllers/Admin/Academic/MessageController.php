<?php

namespace App\Http\Controllers\Admin\Academic;

use App\Http\Controllers\Controller;
use App\Models\Membership_Messages;
use App\Models\Membership_replies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class MessageController extends Controller
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
    public function inbox(){
        if (Gate::allows('is-admin')) {
            // Pluck all User Roles
            $userRoleCollection = Auth::user()->roles;

            // Remap User Roles into array with Organization ID
            $userRoles = array();
            foreach ($userRoleCollection as $role) 
            {
                array_push($userRoles, ['role' => $role->role, 'organization_id' => $role->pivot->organization_id]);
            }    
            
            // Get the Organization from which the user is Membership Admin
            $userRoleKey = $this->hasRole($userRoles, 'Membership Admin');
            $organizationID = $userRoles[$userRoleKey]['organization_id'];

            $membership_messages = Membership_replies::join('users','users.user_id','=','membership_replies.user_id')
                                ->join('organizations','organizations.organization_id','=','membership_replies.organization_id')
                                ->where('membership_replies.organization_id', $organizationID)
                                ->orderBy('reply_id','DESC')
                                ->paginate(10);

            return view('admin.messages.academic.inbox', compact('membership_messages'));
        }else{
            abort(403);
        }
    }

    public function sent(){
        if (Gate::allows('is-admin')) {
            // Pluck all User Roles
            $userRoleCollection = Auth::user()->roles;

            // Remap User Roles into array with Organization ID
            $userRoles = array();
            foreach ($userRoleCollection as $role) 
            {
                array_push($userRoles, ['role' => $role->role, 'organization_id' => $role->pivot->organization_id]);
            }    
            
            // Get the Organization from which the user is Membership Admin
            $userRoleKey = $this->hasRole($userRoles, 'Membership Admin');
            $organizationID = $userRoles[$userRoleKey]['organization_id'];

            $membership_messages = Membership_Messages::join('users','users.user_id','=','membership_messages.user_id')
                                ->join('organizations','organizations.organization_id','=','membership_messages.organization_id')
                                ->where('membership_messages.organization_id', $organizationID)
                                ->orderBy('message_id','DESC')
                                ->paginate(10);

            return view('admin.messages.academic.sents', compact('membership_messages'));
        }else{
            abort(403);
        }
    }

    public function reply(Request $request, $id){
        if (Gate::allows('is-admin')) { 
            // Pluck all User Roles
            $userRoleCollection = Auth::user()->roles;

            // Remap User Roles into array with Organization ID
            $userRoles = array();
            foreach ($userRoleCollection as $role) 
            {
                array_push($userRoles, ['role' => $role->role, 'organization_id' => $role->pivot->organization_id]);
            }    
            
            // Get the Organization from which the user is Membership Admin
            $userRoleKey = $this->hasRole($userRoles, 'Membership Admin');
            $organizationID = $userRoles[$userRoleKey]['organization_id'];

            abort_if(! Membership_replies::where('reply_id', $id)->exists(), 403);

            $request->validate([
                'user_id' => ['required','integer'],
                'reply' => ['required','string','max:255'],
                'organization_id' => ['required','integer']
            ]);

            $membership_replies = Membership_Messages::create([
                
                'user_id' => $request['user_id'],
                'organization_id' => $request['organization_id'],
                'message' => $request['reply']
            ]);

            return Redirect(route('membership.admin.academic.inbox'))->with('success','Reply sent!');
        }else{
            abort(403);
        }
    }

    public function read($id){
        abort_if(! Membership_replies::where('reply_id', $id)->exists(), 403);
        Membership_replies::where('reply_id',$id)->update(['status' => 'read']);
        return redirect()->back();

    }
}