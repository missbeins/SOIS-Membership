<?php

namespace App\Http\Controllers\Admin\Membership\Academic;

use App\Http\Controllers\Controller;
use App\Models\Academic_Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddAcademicMembershipController extends Controller
{
    public function addMembership(Request $request){
        $adminOrg = Auth::user()->course['organization_id'];
        
        $data = $request->validate([
            'semester' => ['required'],
            'school_year' => ['required'],
            'start_date' => ['required','date'],
            'end_date' => ['required', 'date']
        ]);
        
        $academic_membership = Academic_Membership::create([
            'organization_id' => $adminOrg,
            'semester' => $data['semester'],
            'school_year' =>  $data['school_year'],
            'start_date' =>  $data['start_date'],
            'end_date' =>  $data['end_date'],
            
        
        ]);

        return redirect()->back();
    }
}
