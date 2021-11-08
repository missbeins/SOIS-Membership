<?php

namespace App\Http\Controllers\Admin\Academic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Academic_Membership;
use Illuminate\Support\Facades\Auth;

class CountsController extends Controller
{
    public function counter(){
        $members = Academic_Membership::all()
            ->where('subcription','=','paid')
            ->where('approval_status','=','approved')
            ->count();
        $unpaid_members = Academic_Membership::all()
            ->where('subcription','=','unpaid')
            ->where('approval_status','=','approved')
            ->count();
        $applications = Academic_Membership::all()
            ->where('subcription','=','unpaid')
            ->where('approval_status','=','pending')
            ->count();

        return view('admin.users.index',compact([
            'members',
            'unpaid_members',
            'applications'
        ]));
    }
}
