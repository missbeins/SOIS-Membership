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
    
    <div class="container-fluid px-2">
        <div class="row g-3">
            <div class="col-md-3">
                <div class="cardcon p-3 bg-white d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2 text-center">{{ $activeMembersCount }}</h3>
                        <p class="fs-5">Active Members</p>
                    </div>
                    <i class="fas fa-users fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </div>
            <div class="col-md-3">
                <div class="cardcon p-3 bg-white d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2 text-center">{{ $applications }}</h3>
                        <p class="fs-5">Application Requests</p>
                    </div>
                    <i class="fas fa-address-book fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </div>

            <div class="col-md-3">
                <div class="cardcon p-3 bg-white  d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2 text-center">{{ $membershipCount }}</h3>
                        <p class="fs-5">Total Memberships</p>
                    </div>
                    <i class="fas fa-hand-holding-usd fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </div>
            <div class="col-md-3">
                <div class="cardcon p-3 bg-white  d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2 text-center">{{ $accountRegistrantsCount }}</h3>
                        <p class="fs-5">Account Registrants</p>
                    </div>
                    <i class="fas fa-registered fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="mt-3">
            {{-- Title and Breadcrumbs --}}
            <div class="d-flex justify-content-between align-items-center">
                
                {{-- Breadcrumbs --}}
                <nav aria-label="breadcrumb align-items-center">
                    <ol class="breadcrumb justify-content-center ">
                        
                        <li class="breadcrumb-item active" aria-current="page">
                            Organization / Memberships / Reports
                        </li>

                    </ol>
                </nav>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="float-left">Organization Memberships</h4>

                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive text-center">
                    <table class="table table-hover table-striped table-bordered table-light " id="memberships">
                        <thead>
                            <tr> 
                                
                                <th class="col-sm-2">Semester</th>
                                <th class="col-sm-2">School Year</th>
                                <th class="col-sm-1">Status</th>
                                <th class="col-sm-7">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($academic_memberships->isNotEmpty())
                                @foreach ($academic_memberships as $membership)
                                    <tr>
                                        <td>{{ $membership->semester }}</td>
                                        <td>{{ $membership->school_year }}</td>
                                        @if ($membership->am_status == 'Active')
                                            <td><span class="badge bg-success">{{ $membership->am_status }}</span></td>
                                        @else
                                            <td><span class="badge bg-danger">{{ $membership->am_status }}</span></td>
                                        @endif
                                        <td>
                                            <a href="{{ route('membership.admin.academic.memberships-members', $membership->academic_membership_id) }}" type="button" class="btn btn-info"><i class="fas fa-eye me-2"></i>Members</a>

                                            <a href="{{ route('membership.admin.academic.memberships-details', $membership->academic_membership_id) }}" type="button" class="btn btn-info"><i class="fas fa-eye me-2"></i>Details</a>
                                            {{-- <a href="{{ route('membership.admin.academic.generateAcadMembershipPDF') }}" class="btn btn-warning" onclick="event.preventDefault();
                                            document.getElementById('pdf-form').submit();"><i class="fas fa-file-pdf me-2"></i>Generate PDF</a>
                                         --}}<a href="{{ route('membership.admin.academic.generateAcadMembershipPDF', $membership->academic_membership_id) }}" class="btn btn-warning"><i class="fas fa-file-pdf me-2"></i>Generate PDF</a>
                            
                                            {{-- <form id="pdf-form" action="{{ route('membership.admin.academic.generateAcadMembershipPDF') }}" method="POST" class="d-none">
                                                @csrf
                                                <input type="hidden" name="membership_id" value="{{ $membership->academic_membership_id }}">
                                            </form> --}}
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $membership->academic_membership_id }}">
                                                <i class="fas fa-file-pdf me-2"></i>Generate PDF by Year Level
                                            </button>
                                            @include('admin.reports.academic.includes.generate-pdf')
                                        </td>
                                    </tr>
                                @endforeach
                        @else
                            <tr><td class="text-center" colspan="9">No results found!</td></tr>
                        @endif
                        </tbody>
                    </table>
                    
                    {{ $academic_memberships->links() }}
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

