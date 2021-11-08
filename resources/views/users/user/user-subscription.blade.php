@extends('membership.dashboard')

@section('content')

    <div class="container">
        <h3>My Subscriptions</h3>
        @foreach ($membership as $member)
            <div class="card text-dark bg-light mb-3">
                <div class=" card-header text-light" style="background-color: #c62128">Academic Organizations</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <th>Organization</th>
                            <th>Proof of Payment</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $member->organization_name }}</td>
                                <td>Image here</td>
                                <td class="text-success">Verified</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
@endsection
