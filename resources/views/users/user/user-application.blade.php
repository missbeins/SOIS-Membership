@extends('membership.dashboard')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="card text-dark bg-light mb-3">
                    <div class=" card-header text-light" style="background-color: #c62128">Membership Applications
                        <button type="button" class="btn btn-success btn-sm float-end" data-bs-toggle="modal" data-bs-target="#applicationform">
                            Apply
                         </button>
                         @include('users.user.application-form')
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-striped table-hover table-responsive text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Organization</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">School Year</th>
                                    <th scope="col">Registration</th>
                                
                                </tr>
                            </thead>
                            <tbody>
                                
                                    @foreach ($academic_memberships as $academic_membership)
                                        <tr>
                                            <td>{{ $academic_membership->organization_name }}</td>
                                            <td>{{ $academic_membership->semester }}</td>
                                            <td>{{ $academic_membership->school_year }}</td>
                                            <td>{{ $academic_membership->status }}</td>
                                            {{-- <td>
                                                @if ($academic_membership->status == 'Close' || $academic_membership->status == 'close')
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#applicationform" disabled>
                                                        Apply
                                                    </button>
                                                @else
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#applicationform">
                                                   Apply
                                                </button>
                                                
                                                @endif
                                                @include('users.user.application-form')
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                    
                                
                                @foreach ($non_academic_memberships as $non_academic_membership)
                                    <tr>
                                        <td>{{ $non_academic_membership->organization_name }}</td>
                                        <td>{{ $non_academic_membership->semester }}</td>
                                        <td>{{ $non_academic_membership->school_year }}</td>
                                        <td>{{ $non_academic_membership->status }}</td>
                                        {{-- <td>@if ($non_academic_membership->status == 'Close' || $non_academic_membership->status == 'close')
                                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#applicationform" disabled>
                                                Apply
                                            </button>
                                            @else
                                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#applicationform">
                                                Apply
                                             </button>
                                            @endif
                                            @include('users.user.application-form')
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card text-dark bg-light mb-3">
                    <div class=" card-header text-light" style="background-color: #c62128">Application Status
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-striped table-hover table-responsive text-center">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Organization</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($applications as $application)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $application->organization_name }}</td>
                                        <td>{{ $application->approval_status }}</td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection
