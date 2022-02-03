@extends('membership.dashboard')

@section('content')
    {{-- Title and Breadcrumbs --}}
<div class="d-flex justify-content-between align-items-center">
    
    {{-- Breadcrumbs --}}
    <nav aria-label="breadcrumb align-items-center">
        <ol class="breadcrumb justify-content-center ">
            
            <li class="breadcrumb-item active" aria-current="page">
                Organizations / Non Academic Organizations
            </li>

        </ol>
    </nav>
</div>
    <div class="card">
        <div class=" card-header text-light" style="background-color: #c62128">Non-academic Organizations</div>
        <div class="card-body">
            <table class="table table-striped" id="nonaorgs">
                <thead>
                    <th>Organization</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                </thead>
                <tbody>
                    @if ($organizations->isNotEmpty())

                    @foreach ($organizations as $organization)
                        <tr>
                            <td>{{ $organization->organization_name }}</td>
                            <td>{{ $organization->membership_start_date }}</td>
                            <td>{{ $organization->membership_end_date }}</td>
                            @if ($organization->am_status == 'Close' || $organization->am_status == 'close')
                                <td class="text-danger">{{ $organization->nam_status }}</td>
                            @else
                                <td class="text-success">{{ $organization->nam_status }}</td>
                            @endif
                            
                        </tr>
                    @endforeach
                    @else
                    <tr><td colspan="4">No results found!</td></tr>
                   @endif
                </tbody>
            </table>
           {{ $organizations->links() }}
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
            const dataTable = new simpleDatatables.DataTable("#nonaorgs", {
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
