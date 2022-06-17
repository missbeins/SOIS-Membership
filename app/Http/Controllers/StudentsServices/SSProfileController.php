<?php

namespace App\Http\Controllers\StudentsServices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Gender;
use Illuminate\Support\Facades\Auth;

class SSProfileController extends Controller
{
    public function __invoke(){
        return view('studentservices.profile',[
            'courses' => Course::All(),
            'genders' => Gender::All(),
            'user_id' => Auth::user()->user_id,
        ]);
    }
}
