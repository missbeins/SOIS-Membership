@extends('membership.dashboard')

@section('content')

    <div class="container">

        <h4 class="mb-2">Members Subscriptions</h4>

        <table class="table table-success table-sm table-striped table-hover table-responsive text-center">
            <thead>
                <tr>
                    <th scope="col" width="50">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Proof of Payment</th>
                    <th scope="col">Settlement</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subscriptions as $subscription)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $subscription->last_name }}, {{ $subscription->first_name }}
                            {{ $subscription->middle_name }}</td>
                        <td>{{ $subscription->email }}</td>
                        <td>{{ $subscription->mobile_number }}</td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm text-light" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                                <i class="fas fa-eye text-light"> View</i>
                            </button>
                            @include('admin.subscription.includes.image')
                        </td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm text-light" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop{{ $subscription->academic_member_id }}">
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
