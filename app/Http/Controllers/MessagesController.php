<?php

namespace App\Http\Controllers;

use App\Models\Membership_Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function index(){
        $messages = Membership_Messages::join('organizations','organizations.organization_id','=','membership_messages.organization_id')
                ->where("user_id",Auth::user()->user_id)->get();
        return view('users.user.Academic.messages', compact('messages'));
    }
}
