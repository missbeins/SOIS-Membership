<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Gender;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function __invoke(){
        return view('users.profile',[
            'courses' => Course::All(),
            'genders' => Gender::All()
        ]);
    }
}
