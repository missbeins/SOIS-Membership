@extends('membership.dashboard')

@section('content')

    <div class="container">
        <h3>Messages</h3>
        {{-- @foreach ($membership as $member) --}}
            <div class="card text-dark bg-light mb-3">
                <div class=" card-header text-light" style="background-color: #c62128">Organizations</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <th class="col-md-1">#</th>
                            <th class="col-md-2">Organization</th>
                            <th class="col-md-5">Message</th>
                            <th class="col-md-1">Action</th>
                        </thead>
                        <tbody>
                           {{-- @foreach ($organizations as $organization)
                               <tr>
                                   <td>{{ $loop->iteration }}</td>
                                   <td>{{ $organization->organization_name }}</td>
                                   <td>{{ $organization->semester }}</td>
                                   <td>{{ $organization->school_year }}</td>
                                   <td>₱ {{ $organization->membership_fee }}.00</td>
                                   <td class="text-danger">{{ $organization->membership_status }}</td>
                               </tr>
                           @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        {{-- @endforeach --}}
    </div>
@endsection
