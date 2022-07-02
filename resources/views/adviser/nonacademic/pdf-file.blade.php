<!DOCTYPE html>
<html>
<head>
    <title>Organization's Membership</title>
    <link rel="stylesheet" href="{{ public_path('css/pdf-file.css') }}">
</head>
<body>

    <div class="page">
        <!-- Define header and footer blocks before your content -->
        <header>
            <div class="left-div">
                <img src="{{ public_path('images/pup-logo-Polytechnic_University_of_the_Philippines.png') }}" style="width: 100px; height: 100px">
                <img src="{{ public_path('/storage/'. $organization->logo->file) }}" style="width: 100px; height: 100px">

            </div>
            <div class="right-div">
                    <small>Republic of the Philippines   </small>
                    <p> POLYTECHNIC UNIVERSITY OF THE PHILIPPINES</p>
                    <p>Office of the Vice President for Branches and Satellite Campuses</p>
                    <p>TAGUIG BRANCH</p>
                    <p>Office of Student Services</p>
                    <p style="text-transform: uppercase;">{{ $organization->organization_name }}</p>
            </div>
        </header>
        <hr>
        <h4 class="text-center">
            ORGANIZATIONS MEMBERSHIP  <br>
            @if ($acad_membership->semester == '1st Semester')
                FIRST SEMESTER
            @else
                SECOND SEMESTER
            @endif
            <br>
            ACADEMIC YEAR {{ $acad_membership->school_year }}
            <br>
            TOTAL REGISTERED MEMBERS: {{ $membersCount }}
        </h4>
        <div>
            @if (isset($members))
                <table class="main-table">
                    <thead>
                        <tr>
                            <th>Control No.</th>
                            <th>Name</th>
                            <th>Student Number</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Course</th>
                            <th>Year & Section</th>
                            <th>Gender</th>
                            <th>Contact</th>
                            <th>Date of Birth</th>
                            <th>Amount Paid</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @php
                            $data = 0
                        @endphp
                        @if ($members->isNotEmpty())
                            @foreach ($members as $member)
                                <tr>
                                    <td>{{ $member->control_number }}</td>
                                    <td>{{ $member->first_name }} {{ $member->middle_name }} {{ $member->last_name }} {{ $member->suffix }}</td>
                                    <td>{{ $member->student_number }}</td>
                                    <td>{{ $member->address }}</td>
                                    <td>{{ $member->email }}</td>
                                    <td>{{ $member->course_acronym }}</td>
                                    <td>{{ $member->year_and_section }}</td>
                                    <td>{{ $member->gender }}</td>
                                    <td>{{ $member->contact }}</td>
                                    <td>{{ date_format(date_create($member->date_of_birth), 'F d, Y') }}</td>
                                    <td>{{ $acad_membership->membership_fee }}</td>

                                </tr>
                               @php
                                   $data++;
                               @endphp
                                @if ($data == 4)

                                </tbody>
                                </table>
                                <footer>
                                    <p class="footer-text">Gen. Santos Ave. Lower Bicutan, Taguig City 1772; (Direct Line) 837-5858 to 60; (Telefax) 837-5859;</p>

                                     <p>website: www.pup.edu.ph     e-mail: taguig@pup.edu.ph </p>

                                         <p>“THE COUNTRY’S 1st POLYTECHNIC UNIVERSITY”</p>

                                </footer>
                                @if (!$loop->last)
                                <div class="page-break"></div>
                                <header>
                                    <div class="left-div">
                                        <img src="{{ public_path('images/pup-logo-Polytechnic_University_of_the_Philippines.png') }}" style="width: 100px; height: 100px">
                                        <img src="{{ public_path('/storage/'. $organization->logo->file) }}" style="width: 100px; height: 100px">

                                    </div>
                                    <div class="right-div">
                                            <small>Republic of the Philippines   </small>
                                            <p> POLYTECHNIC UNIVERSITY OF THE PHILIPPINES</p>
                                            <p>Office of the Vice President for Branches and Satellite Campuses</p>
                                            <p>TAGUIG BRANCH</p>
                                            <p>Office of Student Services</p>
                                            <p>COMPUTER SOCIETY</p>
                                    </div>
                                </header>
                                <hr>
                                <table class="main-table">
                                     <thead>
                                        <tr>
                                            <th>Control No.</th>
                                            <th>Name</th>
                                            <th>Student Number</th>
                                            <th>Address</th>
                                            <th>Email</th>
                                            <th>Course</th>
                                            <th>Year & Section</th>
                                            <th>Gender</th>
                                            <th>Contact</th>
                                            <th>Date of Birth</th>

                                            <th>Amount Paid</th>
                                        </tr>
                                    </thead>
                                <tbody class="text-center">
                                @endif



                                    @php
                                        $data=0;
                                    @endphp
                                @endif

                            @endforeach

                        @else
                        <tr><td colspan="12">No results found!</td></tr>
                        @endif
                    </tbody>
                </table>

            @endif
        </div>
        <footer>

            <p class="footer-text">Gen. Santos Ave. Lower Bicutan, Taguig City 1772; (Direct Line) 837-5858 to 60; (Telefax) 837-5859;</p>

             <p>website: www.pup.edu.ph     e-mail: taguig@pup.edu.ph </p>

                 <p>“THE COUNTRY’S 1st POLYTECHNIC UNIVERSITY”</p>


         </footer>

    </div>
</body>
</html>
