@extends('membership.dashboard')

@section('content')
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </symbol>
</svg>

<div class="mt-2">
    
    {{-- Title and Breadcrumbs --}}
    <div class="d-flex justify-content-between align-items-center">
       
        {{-- Breadcrumbs --}}
        <nav aria-label="breadcrumb align-items-center">
            <ol class="breadcrumb justify-content-center ">
                
                <li class="breadcrumb-item active" aria-current="page">
                    Organizations / Non-academic Organizations
                </li>

            </ol>
        </nav>
    </div>
    @if (isset($errors) && $errors->any())
        <div class="alert alert-danger alert-dismissible mt-2">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>

            @foreach ($errors->all() as $error )
                {{ $error }}
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        </div>
    @endif
    <div class="card">
        <div class=" card-header text-light" style="background-color: #c62128">
            <h6 class="float-left">Non-academic Organizations</h6>
            
        </div>
        <div class="card-body table-responsive text-center">
                <table class="table table-hover table-striped table-bordered table-light" id="expected">
                <thead>
                    <tr> 
                        
                        <th class="col-sm-1">#</th>
                        <th class="col-sm-6">Organizations</th>
                        <th class="col-sm-4">Actions</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @if ($nonacadOrgs->isNotEmpty())
                        @foreach ($nonacadOrgs as $org)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $org->organization_name }}</td>
                                <td>
                                    <a href="{{ route('membership.student-services.nonacadOrgsMemberships', $org->organization_id) }}" type="button" class="btn btn-info"><i class="far fa-eye me-2"></i>View memberships</a>
                                </td> 
                                
                            </tr>
                        @endforeach
                    @else
                        <tr><td class="text-center" colspan="7">No results found!</td></tr>
                    @endif
                </tbody>
            </table>
           {{ $nonacadOrgs->links() }}
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
            const dataTable = new simpleDatatables.DataTable("#expected", {
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
