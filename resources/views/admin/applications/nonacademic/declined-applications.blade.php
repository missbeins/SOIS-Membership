@extends('membership.dashboard')

@section('content')

<div class="mt-3">
    {{-- Title and Breadcrumbs --}}
    <div class="d-flex justify-content-between align-items-center">
       
        {{-- Breadcrumbs --}}
        <nav aria-label="breadcrumb align-items-center">
            <ol class="breadcrumb justify-content-center ">
                
                <li class="breadcrumb-item active" aria-current="page">
                    Applications / Declined Applications
                </li>

            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="float-left">Membership Declined Applications</h5>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive text-center">
            <table class="table table-hover table-striped table-bordered table-light">
                <thead>
                    <tr> 
                        <th class="col-sm-1">#</th>
                        <th class="col-sm-4">Name</th>
                        <th class="col-sm-4">Email</th>
                        <th class="col-sm-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($nonacad_applications->isNotEmpty())
                        @foreach ($nonacad_applications as $application)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $application->first_name }} {{ $application->middle_name }} {{ $application->last_name }}</td>
                                <td>{{ $application->email }}</td>
                            
                                <td>
                                     <!-- Button trigger accept modal -->
                                     <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#details{{ $application->application_id }}">
                                        <i class="fas fa-eye"></i> Details
                                    </button>
                                    @include('admin.applications.nonacademic.includes.details')    
                                    <!-- Button trigger accept modal -->
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#reason{{ $application->application_id }}">
                                        <i class="fas fa-eye"></i> View Reason
                                    </button>
                                    @include('admin.applications.nonacademic.includes.reason')
                                    
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr><td class="text-center" colspan="7">No results found!</td></tr>
                    @endif    
                </tbody>
            </table>
            {{ $nonacad_applications->links() }}
        </div>
    </div>
</div>

   
@endsection
