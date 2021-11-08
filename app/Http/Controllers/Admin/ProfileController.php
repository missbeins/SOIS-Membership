<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class ProfileController extends Controller
{
    public function __invoke(){
        return view('admin.users.profile',[
            'courses' => Course::All()
        ]);
    }
}
