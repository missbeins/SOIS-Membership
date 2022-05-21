@extends('membership.dashboard')

@section('content')
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </symbol>
</svg>
    @if (isset($errors) && $errors->any())
        <div class="alert alert-danger alert-dismissible" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>

            @foreach ($errors->all() as $error )
                {{ $error }}
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        </div>
    @endif
    
   
    
    <div class="container-fluid">
        <div class="mt-3">
            {{-- Title and Breadcrumbs --}}
            <div class="d-flex justify-content-between align-items-center">
                
                {{-- Breadcrumbs --}}
                <nav aria-label="breadcrumb align-items-center">
                    <ol class="breadcrumb justify-content-center ">
                        
                        <li class="breadcrumb-item active" aria-current="page">
                            Organization / Memberships
                        </li>

                    </ol>
                </nav>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="float-left">Organization Memberships</h4>
                            <!-- Button trigger modal -->
                            @if (!isset($getActiveMembership))
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addmembership">
                                    Start New Membership
                                </button>
                                @include('admin.memberships.academic.addacademicmembership')
                            @endif
                                
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive text-center">
                    <table class="table table-hover table-striped table-bordered table-light " id="memberships">
                        <thead>
                            <tr> 
                                <th class="col-sm-1">#</th>
                                <th class="col-sm-1">Semester</th>
                                <th class="col-sm-1">School Year</th>
                                <th class="col-sm-1">Fee</th>
                                <th class="col-sm-1">Start Date</th>
                                <th class="col-sm-1">End Date</th>
                                <th class="col-sm-2">Registration Status</th>
                                <th class="col-sm-1">Status</th>
                                <th class="col-sm-1">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($academic_memberships->isNotEmpty())
                                @foreach ($academic_memberships as $membership)
                                    <tr>
                                        <th scope="row" class="pt-4">{{ $loop->iteration }}</th>
                                        <td class="pt-4">{{ $membership->semester }}</td>
                                        <td class="pt-4">{{ $membership->school_year }}</td>
                                        <td class="pt-4">₱ {{ $membership->membership_fee }}.00</td>
                                        <td class="pt-4">{{date_format(date_create($membership->membership_start_date), 'M. d, Y' )   }}</td>
                                        <td class="pt-4">{{date_format(date_create($membership->membership_end_date), 'M. d, Y' )   }}</td>
                                        <td class="pt-4">{{ $membership->registration_status }}<br>( available from {{date_format(date_create($membership->registration_start_date), 'M. d, Y' )   }} to {{date_format(date_create($membership->registration_end_date), 'M. d, Y' )   }} )</td>
                                        @if ($membership->am_status== 'Ended' || $membership->am_status == 'ended')
                                            <td class="pt-4"><span class="badge bg-danger">{{ $membership->am_status }}</span></td>
                                        @else
                                            <td class="pt-4"><span class="badge bg-success">{{ $membership->am_status }}</span></td>
                                        @endif
                                        <td class="pt-4">
                                                <a role="button" class="btn btn-sm btn-primary"
                                                    href="{{ route('membership.admin.academic.academicmembership.edit',[ $membership->academic_membership_id, $membership->organization_id]) }}">
                                                    <i class="fas fa-user-edit"></i> Edit
                                                </a>
                                                {{-- <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="event.preventDefault(); document.getElementById('delete-membership-form-{{ $membership->academic_membership_id }}').submit()">
                                                    <i class="fas fa-trash-alt"></i> Delete
                                                </button>
                                                <form class="d-none" id="delete-membership-form-{{ $membership->academic_membership_id }}"
                                                    action="{{ route('membership.admin.academicmembership.destroy',  $membership->academic_membership_id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form> --}}
                                        </td>
                                    </tr>
                                @endforeach
                        @else
                            <tr><td class="text-center" colspan="9">No results found!</td></tr>
                        @endif
                        </tbody>
                    </table>
                    
                    {{-- {{ $academic_memberships->links() }} --}}
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
            const dataTable = new simpleDatatables.DataTable("#memberships", {
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

