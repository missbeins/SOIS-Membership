@extends('membership.dashboard')

@section('content')
    <div class="container-fluid px-2">
        <div class="row g-3">
            {{-- <div class="col-md-6">
                <div class="cardcon p-3 bg-white d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2 text-center">{{ $members }}</h3>
                        <p class="fs-5">Members</p>
                    </div>
                    <i class="fas fa-users fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </div> --}}
            <div class="col-md-5">
                <div class="cardcon p-3 bg-white d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2 text-center">{{ $applications }}</h3>
                        <p class="fs-5">Application Requests</p>
                    </div>
                    <i class="fas fa-address-book fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </div>

            {{-- <div class="col-md-4">
                <div class="cardcon p-3 bg-white  d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2 text-center">{{ $unpaid_members }}</h3>
                        <p class="fs-5">Unpaid Members</p>
                    </div>
                    <i class="fas fa-hand-holding-usd fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </div> --}}
        </div>
    </div>
    @if (isset($errors) && $errors->any())
        <div class="alert alert-danger mt-2">
            @foreach ($errors->all() as $error )
                {{ $error }}
            @endforeach
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
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addmembership">
                                    Start New Membership
                                </button>
                            @include('admin.memberships.academic.addacademicmembership')
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive text-center">
                    <table class="table table-hover table-striped table-bordered table-light ">
                        <thead>
                            <tr> 
                                <th class="col-sm-1">#</th>
                                <th class="col-sm-1">@sortablelink('semester','Semester')</th>
                                <th class="col-sm-1">@sortablelink('school_year','School Year')</th>
                                <th class="col-sm-1">@sortablelink('membership_fee','Fee')</th>
                                <th class="col-sm-1">@sortablelink('membership_start_date','Start Date')<br><small>( yyyy-mm-dd )</small></th>
                                <th class="col-sm-1">@sortablelink('membership_end_date','End Date')<br><small>( yyyy-mm-dd )</small></th>
                                <th class="col-sm-2">@sortablelink('registration_status','Registration Status') <br><small>( yyyy-mm-dd )</small></th>
                                <th class="col-sm-1">@sortablelink('am_status','Status')</th>
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
                                        <td class="pt-4">{{ $membership->membership_start_date }}</td>
                                        <td class="pt-4">{{ $membership->membership_end_date }}</td>
                                        <td class="pt-4">{{ $membership->registration_status }}<br>( available from {{ $membership->registration_start_date }} to {{ $membership->registration_end_date }} )</td>
                                        <td class="pt-4">{{ $membership->am_status }}</td>
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
                    
                    {!! $academic_memberships->appends(Request::except('page'))->render() !!}
                    <p>
                        Displaying {{$academic_memberships->count()}} of {{ $academic_memberships->total() }} academic membership(s).
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
