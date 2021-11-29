@extends('membership.dashboard')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-2">Membership Payments</h4>
                <button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    Import
                </button>
            </div>
        </div>
            

        <table class="table table-success table-sm table-striped table-hover table-responsive text-center">
            <thead>
                <tr>
                    <th scope="col" width="50">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Settlement</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($unpaidmembers as $member)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $member->last_name }}, {{ $member->first_name }}
                            {{ $member->middle_name }}</td>
                        <td>{{ $member->email }}</td>
                        <td>{{ $member->contact }}</td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm text-light" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop{{ $member->academic_member_id }}">
                                <i class="fas fa-edit text-light"> Settle</i>
                            </button>
                        </td>
                        @include('admin.subscription.includes.modal')
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
