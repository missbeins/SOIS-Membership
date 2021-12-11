@extends('membership.dashboard')

@section('content')
<div class="mt-3">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-8">
                    <h5 class="float-left">Membership Payments</h5>
                </div>
                <div class="input-group col-md-4" style="width:30%">
                    <label class="input-group-text" for="inputGroupSelect01">Filter</label>
                    <select class="form-select" id="inputGroupSelect01">
                        @foreach ($academic_memberships as $academic_membership)
                            <option value="{{ $academic_membership->academic_membership_id }}">{{ $academic_membership->semester }}({{ $academic_membership->school_year }})</option>                           
                        @endforeach 
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive text-center">
        {{-- <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="mb-2">Membership Payments</h4>
                    {{-- <button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop">
                                        Import Receipts
                </button>
                </div>
            </div> --}}
            

            <table class="table table-light table-sm table-striped table-hover table-responsive">
                <thead>
                    <tr>
                        <th class="col-sm-1">Control Number</th>
                        <th class="col-sm-1">Name</th>
                        <th class="col-sm-1">Email</th>
                        <th class="col-sm-1">Contact</th>
                        <th class="col-sm-1">Amount Paid</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($paidmembers as $member)
                        <tr>
                            <td> {{ $member->control_number }}</td>
                            <td>{{ $member->last_name }}, {{ $member->first_name }}
                                {{ $member->middle_name }}</td>
                            <td>{{ $member->email }}</td>
                            <td>{{ $member->contact }}</td>
                            <td>₱ {{ $member->membership_fee }}.00</td>
                            {{-- <td>
                                <button type="button" class="btn btn-success btn-sm text-light" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop{{ $member->academic_member_id }}">
                                    <i class="fas fa-edit text-light"> Settle</i>
                                </button>
                            </td>
                            @include('admin.subscription.includes.modal') --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
