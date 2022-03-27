<?php

namespace App\Http\Controllers\Admin\Nonacademic;

use App\Http\Controllers\Controller;
use App\Models\Membership_Messages;
use App\Models\Membership_replies;
use App\Models\Non_Academic_Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class NonAcademicMessagesController extends Controller
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
                                // ->orderBy('reply_id', 'DESC')
                                ->orderBy('reply_id','DESC')
                                ->paginate(7);

            return view('admin.messages.nonacademic.inbox', compact('membership_messages'));
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
                                ->paginate(7);
            $year_and_sections = Non_Academic_Members::join('non_academic_membership','non_academic_membership.non_academic_membership_id','=','membership_id')
                                ->where('non_academic_membership.nam_status','=','Active')
                                ->select('year_and_section')
                                ->get();
            $yearlevels = collect([]);

            foreach ($year_and_sections as  $year_and_section) {
            $yearlevels->push($year_and_section);
            }
            $newyearLevelscollection = $yearlevels->unique('year_and_section');
            return view('admin.messages.nonacademic.sents', compact('membership_messages','newyearLevelscollection'));
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

            return Redirect(route('membership.admin.nonacademic.inbox'))->with('success','Reply sent!');
        }else{
            abort(403);
        }
    }
    public function readMessage($id){
        abort_if(! Membership_Messages::where('message_id', $id)->exists(), 404);
        Membership_Messages::where('message_id',$id)->update(['message_status' => 'read']);
        return redirect()->back();

    }

    public function readReply($id){
        abort_if(! Membership_replies::where('reply_id', $id)->exists(), 404);
        Membership_replies::where('reply_id',$id)->update(['message_status' => 'read']);
        return redirect()->back();

    }
    public function showMassMessage(Request $request){
        if (Gate::allows('is-admin')) { 
            // dd($request->year_and_section);
            $year_and_sections = $request->year_and_section;
            // dd($year_and_sections);
          
            // dd($newYearRange);
            if($request->has('allmembers')) {
                
                $members = Non_Academic_Members::join('non_academic_membership','non_academic_membership.non_academic_membership_id','=','membership_id')
                ->where('non_academic_membership.nam_status','=','Active')
                ->get();
                return view('admin.messages.nonacademic.massMessageFormAllMembers', compact('members'));

            } else {
                $yearRange = collect([]);
    
                foreach ($year_and_sections as  $range) {
                    $yearRange->push($range);
                }
                $newYearRange = $yearRange;
                $members = Non_Academic_Members::join('non_academic_membership','non_academic_membership.non_academic_membership_id','=','membership_id')
                    ->where('non_academic_membership.nam_status','=','Active')
                    ->whereIn('non_academic_members.year_and_section',$year_and_sections)
                    ->get();
                return view('admin.messages.nonacademic.massMessageFormByYearLevel', compact(['members','newYearRange']));

            }
            // dd($members);
        }else{
            abort(403);
        }
    }
    public function massMessageAllMembers(Request $request){
        if (Gate::allows('is-admin')) { 
            // dd($request);
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

            $request->validate([
            
                'message' => ['required','string','max:255'],
            
            ]);

            $members = Non_Academic_Members::join('non_academic_membership','non_academic_membership.non_academic_membership_id','=','membership_id')
                    ->where('non_academic_membership.nam_status','=','Active')
                    ->where('non_academic_membership.organization_id',$organizationID)
                    ->get();

            foreach ($members as $member) {
                Membership_Messages::create([
                    'user_id' => $member->user_id,
                    'organization_id' => $member->organization_id,
                    'message' => $request['message']
                ]);
            }
            return Redirect(route('membership.admin.nonacademic.sent'))->with('success','Messages sent!');
        
        }else{
            abort(403);
        }
    }
    public function massMessageByYearLevel(Request $request){
        // dd($request);
           
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
        $this->validate($request, [
            'recipients' => 'required',
            'recipients.*' => 'string',
            'message' => ['required','max:255'],
        ]);
        $yearLevelsCollection = $request->year_and_section;
        // dd($request['recipients'][0]);
        if($request['recipients'][0] == 'All Members') {
         

            $members = Non_Academic_Members::join('non_academic_membership','non_academic_membership.non_academic_membership_id','=','membership_id')
                    ->where('non_academic_membership.nam_status','=','Active')
                    ->where('non_academic_membership.organization_id',$organizationID)
                    ->get();

            foreach ($members as $member) {
                Membership_Messages::create([
                    'user_id' => $member->user_id,
                    'organization_id' => $member->organization_id,
                    'message' => $request['message']
                ]);
            }
            return Redirect(route('membership.admin.nonacademic.sent'))->with('success','Messages sent!');
          
        
        } else {
            $members = Non_Academic_Members::join('non_academic_membership','non_academic_membership.non_academic_membership_id','=','membership_id')
                    ->where('non_academic_membership.nam_status','=','Active')
                    ->where('non_academic_membership.organization_id',$organizationID)
                    ->whereIn('non_academic_members.year_and_section',$yearLevelsCollection)
                    ->get();

            foreach ($members as $member) {
                Membership_Messages::create([
                    'user_id' => $member->user_id,
                    'organization_id' => $member->organization_id,
                    'message' => $request['message']
                ]);
            }
            return Redirect(route('membership.admin.nonacademic.sent'))->with('success','Messages sent!');
        }  
    }
}
