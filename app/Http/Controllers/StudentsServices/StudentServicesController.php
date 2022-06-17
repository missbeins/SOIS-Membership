<?php

namespace App\Http\Controllers\StudentsServices;

use App\Http\Controllers\Controller;
use App\Models\Academic_Members;
use App\Models\Academic_Membership;
use App\Models\Course;
use App\Models\Gender;
use App\Models\Non_Academic_Members;
use App\Models\Non_Academic_Membership;
use App\Models\Organizations;
use Illuminate\Http\Request;
use PDF;

class StudentServicesController extends Controller
{
    public function academicOrgs(){
        $acadOrgs = Organizations::where('organization_type_id',1)->get();
        return view('studentservices.academic-organizations', compact('acadOrgs'));
    }
    public function nonacademicOrgs(){
        $nonacadOrgs = Organizations::where('organization_type_id',2)->get();
        return view('studentservices.nonacademic-organizations',compact('nonacadOrgs'));
    }
    public function acadOrgsMemberships($org){
        $acads_memberships = Academic_Membership::where('organization_id',$org)->get();
        $year_and_sections = Academic_Membership::join('academic_members','academic_members.membership_id','=','academic_membership.academic_membership_id')
                ->where('academic_membership.organization_id',$org)
                ->select('academic_members.year_and_section')
                ->get();

        $yearLevels = collect([]);

        foreach ($year_and_sections as  $year_and_section) {
        $yearLevels->push($year_and_section);
        }
        $newyearLevelscollection = $yearLevels->unique('year_and_section');
           
        return view('studentservices.acadorgs-memberships',compact(['acads_memberships','newyearLevelscollection']));
    }
    public function nonacadOrgsMemberships($org){
        $nonacads_memberships = Non_Academic_Membership::where('organization_id',$org)->get();
        return view('studentservices.nonacadorgs-memberships',compact('nonacads_memberships'));
    }

    public function showAcadsMembershipDetails($id){
        abort_if(! Academic_Membership::where('academic_membership_id', $id)->exists(), 404);

        $acad_membership = Academic_Membership::where('academic_membership_id', $id)->first();
        
        $members = Academic_Members::join('academic_membership','academic_membership.academic_membership_id','=','academic_members.membership_id')
                ->where('academic_membership.academic_membership_id', $id)
                ->get();
        // dd($members);
        return view('studentservices.acad-show',compact(['acad_membership','members']));
    }
    public function showNonacadsMembershipDetails($id){
        abort_if(! Non_Academic_Membership::where('non_academic_membership_id', $id)->exists(), 404);

        $nonacad_membership = Non_Academic_Membership::where('non_academic_membership_id', $id)->first();
        $members = Non_Academic_Members::join('non_academic_membership','non_academic_membership.non_academic_membership_id','=','non_academic_members.membership_id')
                                        ->where('non_academic_membership_id', $id)
                                        ->get();
        
        return view('studentservices.nonacad-show',compact(['nonacad_membership','members']));
    }

    public function showAcadMemberDetails($id){
        abort_if(! Academic_Members::where('academic_member_id', $id)->exists(), 404);
        $member_detail = Academic_Members::where('academic_member_id', $id)->first();
        $courses = Course::all();
        return view('studentservices.acad-showdetails', compact(['member_detail','courses']));
    }

    public function showNonacadMemberDetails($id){
        abort_if(! Non_Academic_Members::where('non_academic_member_id', $id)->exists(), 404);
        $courses = Course::all();
        $member_detail = Non_Academic_Members::where('non_academic_member_id', $id)->first();
        return view('studentservices.nonacad-showdetails', compact(['member_detail','courses']));
    }

    public function generateAcadMembershipPDF(Request $request){
        $id = $request->membership_id;
        abort_if(! Academic_Membership::where('academic_membership_id', $id)->exists(), 404);

        $acad_membership = Academic_Membership::where('academic_membership_id', $id)->first();
        $members = Academic_Members::join('academic_membership','academic_membership.academic_membership_id','=','academic_members.membership_id')
                    ->join('courses','courses.course_id','=','academic_members.course_id')
                    ->where('academic_membership_id',$id)
                    ->get();
        $courses = Course::all();
        $gender = Gender::all();
        $organization = Organizations::join('academic_members','academic_members.organization_id','=','organizations.organization_id')
                    ->where('academic_members.membership_id',$id)
                    ->first();
        $membersCount = Academic_Members::join('academic_membership','academic_membership.academic_membership_id','=','academic_members.membership_id')
                    ->where('membership_id',$id)
                    ->count();
        $pdf = PDF::loadView('studentservices.academic-pdf-file', compact([
           'acad_membership',
           'members',
           'membersCount',
           'gender',
           'organization'
        ]))->setPaper('legal', 'landscape');
        
        return $pdf->stream('Memberships.pdf');
    }

    public function generateAcadMembershipPDFperYearLevel(Request $request){
        $id = $request->membership_id;
        $yearLevel = $request->yearLevel;
        abort_if(! Academic_Membership::where('academic_membership_id', $id)->exists(), 404);

        $acad_membership = Academic_Membership::where('academic_membership_id', $id)->first();
        $members = Academic_Members::join('academic_membership','academic_membership.academic_membership_id','=','academic_members.membership_id')
                    ->join('courses','courses.course_id','=','academic_members.course_id')
                    ->where('academic_membership_id',$id)
                    ->where('year_and_section',$yearLevel)
                    ->get();
        $courses = Course::all();
        $gender = Gender::all();
        $organization = Organizations::join('academic_members','academic_members.organization_id','=','organizations.organization_id')
                    ->where('academic_members.membership_id',$id)
                    ->first();
        $membersCount = Academic_Members::join('academic_membership','academic_membership.academic_membership_id','=','academic_members.membership_id')
                    ->where('membership_id',$id)
                    ->count();
        $pdf = PDF::loadView('studentservices.academic-pdf-file', compact([
           'acad_membership',
           'members',
           'membersCount',
           'gender',
           'organization'
        ]))->setPaper('legal', 'landscape');
        
        return $pdf->stream('Memberships.pdf');
    }

    public function generateNonacadMembershipPDF($id){
        abort_if(! Non_Academic_Membership::where('non_academic_membership_id', $id)->exists(), 404);

        $nonacad_membership = Non_Academic_Membership::where('non_academic_membership_id', $id)->first();
        $members = Non_Academic_Members::join('non_academic_membership','non_academic_membership.non_academic_membership_id','=','non_academic_members.membership_id')
                ->join('courses','courses.course_id','=','academic_members.course_id')
                ->where('non_academic_membership_id',$id)
                ->get();
        $gender = Gender::all();
        $membersCount = Non_Academic_Members::join('non_academic_membership','non_academic_membership.non_academic_membership_id','=','non_academic_members.membership_id')
                    ->where('membership_id',$id)
                    ->count();
        $organization = Organizations::join('non_academic_members','non_academic_members.organization_id','=','organizations.organization_id')
                    ->where('membership_id',$id)
                    ->get();
        $pdf = PDF::loadView('studentservices.nonacademic-pdf-file', compact([
           'nonacad_membership',
           'members',
           'membersCount',
           'gender',
           'organization'
        ]))->setPaper('legal', 'landscape');
        
        return $pdf->stream('Memberships.pdf');
    }
}
