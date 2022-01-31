@extends('membership.dashboard')

@section('content')

{{-- Title and Breadcrumbs --}}
<div class="d-flex justify-content-between align-items-center">
    
    {{-- Breadcrumbs --}}
    <nav aria-label="breadcrumb align-items-center">
        <ol class="breadcrumb justify-content-center ">
            
            <li class="breadcrumb-item active" aria-current="page">
                Applications / Academic Organizations
            </li>

        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <div class="card text-dark bg-light mb-3">
                    <div class=" card-header text-light" style="background-color: #c62128">Academic Organizations
                        @if ($academic_memberships->isNotEmpty())
                            <a href="{{ route('membership.user.academic.academic-application') }}" type="button" class="btn btn-success btn-sm float-end">
                                Apply
                            </a>
                        @endif
                            
                      
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-striped table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">@sortablelink('organization_name','Organization')</th>
                                    <th scope="col">@sortablelink('semester','Semester')</th>
                                    <th scope="col">@sortablelink('school_year','School Year')</th>
                                    <th scope="col">@sortablelink('registration_status','Status')</th>
                                    
                                
                                </tr>
                            </thead>
                            <tbody>
                                
                                    @foreach ($academic_memberships as $academic_membership)
                                        <tr>
                                            <td>{{ $academic_membership->organization_name }}</td>
                                            <td>{{ $academic_membership->semester }}</td>
                                            <td>{{ $academic_membership->school_year }}</td>
                                            <td>{{ $academic_membership->registration_status }}</td>
                                            
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                        {!! $academic_memberships->appends(Request::except('page'))->render() !!}
                        <p>
                            Displaying {{$academic_memberships->count()}} of {{ $academic_memberships->total() }} academic membership(s).
                        </p>                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <div class="col-md-6">
        <div class="card text-dark bg-light mb-3">
            <div class=" card-header text-light" style="background-color: #c62128">Application Status
            </div>
            <div class="card-body">
                <table class="table table-sm table-striped table-hover table-responsive text-center">
                    <thead>
                        <tr>
                            <th scope="col">@sortablelink('application_id','#')</th>
                            <th scope="col">@sortablelink('organization_name','Organization')</th>
                            <th scope="col">@sortablelink('semester','Semester')</th>
                            <th scope="col">@sortablelink('school_year','School Year')</th>
                            <th scope="col">@sortablelink('membership_fee','Fee')</th>
                            <th scope="col">@sortablelink('application_status','Status')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($application_statuses->isNotEmpty())

                        @foreach ($application_statuses as $application_status)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $application_status->organization_name }}</td>
                                <td>{{ $application_status->semester }}</td>
                                <td>{{ $application_status->school_year }}</td>
                                <td>₱ {{ $application_status->membership_fee }}.00</td>
                                <td>{{ $application_status->application_status }}</td>
                            </tr>
                        @endforeach
                        @else
                            <tr><td class="text-center" colspan="6">No results found!</td></tr>
                        @endif
                    </tbody>
                </table>
                {!! $application_statuses->appends(Request::except('page'))->render() !!}
                <p class="text-center">
                    Displaying {{$application_statuses->count()}} of {{ $application_statuses->total() }} application statuses.
                </p>
            </div>
        </div>
    </div>
</div>

        
@endsection
