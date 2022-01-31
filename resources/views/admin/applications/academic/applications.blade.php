@extends('membership.dashboard')

@section('content')

<div class="mt-3">
    {{-- Title and Breadcrumbs --}}
    <div class="d-flex justify-content-between align-items-center">
       
        {{-- Breadcrumbs --}}
        <nav aria-label="breadcrumb align-items-center">
            <ol class="breadcrumb justify-content-center ">
                
                <li class="breadcrumb-item active" aria-current="page">
                    Applications / Application Requests
                </li>

            </ol>
        </nav>
    </div>
    <div class="card">
        <div class=" card-header text-light" style="background-color: #c62128">
            <div class="row">
                <div class="col-md-12">
                    <h6 class="float-left">Membership Application Requests</h6>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive text-center">
            <table class="table table-hover table-striped table-bordered table-light">
                <thead>
                    <tr> 
                        <th class="col-sm-1">@sortablelink('application_id','#')</th>
                        <th class="col-sm-4">@sortablelink('first_name','Name')</th>
                        <th class="col-sm-4">@sortablelink('email','Email')</th>
                        <th class="col-sm-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($acad_applications->isNotEmpty())
                        @foreach ($acad_applications as $application)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $application->first_name }} {{ $application->middle_name }} {{ $application->last_name }}</td>
                                <td>{{ $application->email }}</td>
                            
                                <td>
                                        
                                        <!-- Button trigger accept modal -->
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#accept{{ $application->application_id }}">
                                            <i class="fas fa-user-check"></i> Accept
                                        </button>
                                        @include('admin.applications.academic.includes.accept')

                                        <!-- Button trigger accept modal -->
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#decline{{ $application->application_id }}">
                                            <i class="fas fa-trash-alt"></i> Decline
                                        </button>
                                        @include('admin.applications.academic.includes.decline')
                                       
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr><td class="text-center" colspan="7">No results found!</td></tr>
                    @endif    
                </tbody>
            </table>
            {{ $acad_applications->links() }}
            {!! $acad_applications->appends(Request::except('page'))->render() !!}
            <p class="text-center">
                Displaying {{$acad_applications->count()}} of {{ $acad_applications->total() }} applications.
            </p>
        </div>
    </div>
</div>

   
@endsection
