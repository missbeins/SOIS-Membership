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
        <div class=" card-header text-light" style="background-color: #c62128">
            <div class="row">
                <div class="col-md-12">
                    <h6 class="float-left">Membership Declined Applications</h6>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive text-center">
            <table class="table table-hover table-striped table-bordered table-light" id="nonadeclined">
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
           {{-- {{ $nonacad_applications->links() }}       --}}
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
            const dataTable = new simpleDatatables.DataTable("#nonadeclined", {
                perPage: 5,
                searchable: true,
                labels: {
                    placeholder: "Search on current page...",
                    noRows: "No data to display in this page or try in the next page.",
                },
            });
        });
    </script>
@endsection

