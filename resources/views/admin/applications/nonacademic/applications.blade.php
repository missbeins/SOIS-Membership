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
            <table class="table table-hover table-striped table-bordered table-light" id="nonapplications">
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
                                <td>{{ $application->first_name }} {{ $application->middle_name }} {{ $application->last_name }} {{ $application->suffix }}</td>
                                <td>{{ $application->email }}</td>
                            
                                <td>
                                        
                                        <!-- Button trigger accept modal -->
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#accept{{ $application->application_id }}">
                                            <i class="fas fa-user-check"></i> Accept
                                        </button>
                                        @include('admin.applications.nonacademic.includes.accept')

                                        <!-- Button trigger accept modal -->
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#decline{{ $application->application_id }}">
                                            <i class="fas fa-trash-alt"></i> Decline
                                        </button>
                                        @include('admin.applications.nonacademic.includes.decline')
                                       
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr><td class="text-center" colspan="7">No results found!</td></tr>
                    @endif    
                </tbody>
            </table>
           {{ $nonacad_applications->links()}}
        </div>
    </div>
</div>

   
@endsection
@push('scripts')
    {{-- Import Datatables --}}
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
@endpush

@section('scripts')
    <script type="module">
        // Simple-DataTables
        // https://github.com/fiduswriter/Simple-DataTables
        window.addEventListener('DOMContentLoaded', event => {
            const dataTable = new simpleDatatables.DataTable("#nonapplications", {
                perPage: 10,
                searchable: true,
                labels: {
                    placeholder: "Search on current page...",
                    noRows: "No data to display in this page or try in the next page.",
                },
            });
        });
    </script>
@endsection

