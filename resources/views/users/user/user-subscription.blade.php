@extends('membership.dashboard')

@section('content')

    <div class="container">
        <h3>My Memberships</h3>
        {{-- @foreach ($membership as $member) --}}
            <div class="card text-dark bg-light mb-3">
                <div class=" card-header text-light" style="background-color: #c62128">Organizations</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <th scope="col">#</th>
                            <th scope="col">Organization</th>
                            <th scope="col">Semester</th>
                            <th scope="col">Schol Year</th>
                            <th scope="col">Fee</th>
                            <th scope="col">Status</th>
                        </thead>
                        <tbody>
                            <tr>
                                {{-- <td>{{ $member->organization_name }}</td>
                                <td>organization name</td>
                                <td class="text-success">Paid</td> --}}
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        {{-- @endforeach --}}
    </div>
@endsection
