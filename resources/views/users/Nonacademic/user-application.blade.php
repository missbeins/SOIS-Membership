@extends('membership.dashboard')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card text-dark bg-light mb-3">
                            <div class=" card-header text-light" style="background-color: #c62128">Non Academic Organizations
                                <a href="{{ route('membership.user.nonacademic.nonacademic-application') }}" type="button" class="btn btn-success btn-sm float-end">
                                    Apply
                                 </a>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-striped table-hover table-responsive" id="nonaorgs">
                                    <thead>
                                        <tr>
                                            <th scope="col">Organization</th>
                                            <th scope="col">Semester</th>
                                            <th scope="col">School Year</th>
                                            <th scope="col">Status</th>
                                           
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                            @foreach ($nonacademic_memberships as $nonacademic_membership)
                                                <tr>
                                                    <td>{{ $nonacademic_membership->organization_name }}</td>
                                                    <td>{{ $nonacademic_membership->semester }}</td>
                                                    <td>{{ $nonacademic_membership->school_year }}</td>
                                                    <td>{{ $nonacademic_membership->registration_status }}</td>
                                                  
                                                </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                                {{-- {{ $nonacademic_memberships->links() }} --}}
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
        
            <div class="col-md-6">
                <div class="card text-dark bg-light mb-3">
                    <div class=" card-header text-light" style="background-color: #c62128">Application Status
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-striped table-hover table-responsive text-center" id="nonastatuses">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Organization</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">School Year</th>
                                    <th scope="col">Fee</th>
                                    <th scope="col">Status</th>
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
                       {{-- {{ $application_statuses->links() }} --}}
                    </div>
                </div>
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
            const dataTable = new simpleDatatables.DataTable("#nonaorgs", {
                perPage: 5,
                searchable: true,
                labels: {
                    placeholder: "Search on current page...",
                    noRows: "No data to display in this page or try in the next page.",
                },
            });
            const dataTable2 = new simpleDatatables.DataTable("#nonastatuses", {
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