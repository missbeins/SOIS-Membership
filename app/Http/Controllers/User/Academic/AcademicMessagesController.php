<?php

namespace App\Http\Controllers\User\Academic;

use App\Http\Controllers\Controller;
use App\Models\Membership_Messages;
use App\Models\Membership_replies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AcademicMessagesController extends Controller
{
    public function index(){
        $messages = Membership_Messages::join('organizations','organizations.organization_id','=','membership_messages.organization_id')
                ->where('user_id',Auth::user()->user_id)->sortable()->get();
        return view('users.Academic.messages', compact('messages'));
    }
    
    public function sent(){
        $messages = Membership_replies::join('organizations','organizations.organization_id','=','membership_replies.organization_id')
                ->where('membership_replies.user_id',Auth::user()->user_id)->sortable()->get();
        return view('users.Academic.sents', compact('messages'));
    }
    public function replyMessage(Request $request, $id){

        abort_if(! Membership_Messages::where('message_id', $id)->exists(), 403);

        $request->validate([
            'user_id' => ['required','integer'],
            'reply' => ['required','string','max:255'],
            'organization_id' => ['required','integer']
        ]);

        $membership_replies = Membership_replies::create([
            'message_id' => $id,
            'user_id' => $request['user_id'],
            'organization_id' => $request['organization_id'],
            'reply' => $request['reply']
        ]);

        return Redirect(route('membership.user.academic.messages'))->with('success','Message sent!');
    }

    public function deleteMessage($id){
        dd($id);
    }
}
