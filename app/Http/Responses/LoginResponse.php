<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    public function toResponse($request)
    {
        
        // below is the existing response
        // replace this with your own code
        // the user can be located with Auth facade
       
        $check = Auth::user()->hasAnyRole([
            "admin",
            
        ]);

        if ($request->wantsJson()) {
            return response()->json(['two_factor' => false]);
        }

        switch ($role) {
            case 'Admin':
                return redirect()->intended(config('fortify.home'));
            case 'User':
                return redirect()->intended('/user/my-organizations');
            default:
                return redirect('/');
        }
        // return $request->wantsJson()
        //             ? response()->json(['two_factor' => false])
        //             : redirect()->intended(config('fortify.home'));
    }

}