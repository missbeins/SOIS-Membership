@extends('membership.dashboard')

@section('content')

    <div class="container">
        <h4 class="mb-2">Official Members</h4>
        <table class="table table-success table-sm table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th scope="col" width="50">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Year and Section</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($paidmembers as $member)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $member->last_name }}, {{ $member->first_name }} {{ $member->middle_name }}</td>
                        <td>{{ $member->email }}</td>
                        <td>{{ $member->gender }}</td>
                        <td>{{ $member->year_and_section }}</td>
                        <td>{{ $member->contact }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm"><i class="fas fa-bell"> Notify</i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
