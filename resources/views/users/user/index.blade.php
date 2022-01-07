@extends('membership.dashboard')

@section('content')

    <div class="container">
        <h3>My Organizations</h3>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class=" card-header text-light" style="background-color: #c62128">Academic Organizations</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <th>Organization</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                @foreach ($organizations as $organization)
                                    <tr>
                                        <td>{{ $organization->organization_name }}</td>
                                        <td>{{ $organization->membership_start_date }}</td>
                                        <td>{{ $organization->membership_end_date }}</td>
                                        @if ($organization->am_status == 'Close' || $organization->am_status == 'close')
                                            <td class="text-danger">{{ $organization->am_status }}</td>
                                        @else
                                            <td class="text-success">{{ $organization->am_status }}</td>
                                        @endif
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-white" style="background-color: #c62128">
                            Non Academic Organizations
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <th>Organization</th>
                                <th>Start Date</th>
                                <th>End Date</th>
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
        </div>        
    </div>
@endsection
