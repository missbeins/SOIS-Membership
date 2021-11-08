@extends('membership.dashboard')

@section('content')

    <div class="container">
        <h3>My Organizations</h3>

        <div class="card  mb-3">
            <div class=" card-header text-light" style="background-color: #c62128">Academic Organizations</div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <th>Organization</th>
                        <th>Validity</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        @foreach ($academic_membership as $member)
                            <tr>
                                <td>{{ $member->organization_name }}</td>
                                <td>{{ $member->validity }}</td>
                                <td class="text-success">{{ $member->subscription }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header text-white" style="background-color: #c62128">
                <h4 class="card-title mb-0"></h4>
                Non-Academic Organizations
                </h4>
            </div>
            <div class="card">
                <table class="table table-striped">
                    <thead>
                        <th>Organization</th>
                        <th>Validity</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        {{-- @foreach ($non_academic_organization as $nonacadOrg)
                            <tr>
                                <td>{{ $nonacadOrg->organization_name }}</td>
                                <td>2022-01-31</td>
                                <td class="text-success">paid</td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
