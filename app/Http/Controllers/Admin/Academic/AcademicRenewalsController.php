<?php

namespace App\Http\Controllers\Admin\Academic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AcademicRenewalsController extends Controller
{
    public function index(){
        return view('admin.renewal.renewals');
    }
}
