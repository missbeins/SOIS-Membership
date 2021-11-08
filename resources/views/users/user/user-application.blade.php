@extends('membership.dashboard')

@section('content')
    <div class="container">
        <div class="card text-dark bg-light mb-3">
            <div class=" card-header text-light" style="background-color: #c62128">Application Status
                <a class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" href="#applicationform" role="button">New
                    application</a>
                @include('users.user.application-form')
            </div>
            <div class="card-body">
                <table class="table table-sm table-striped table-hover table-responsive text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Organization</th>
                            <th scope="col">Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications as $application)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $application->organization_name }}</td>
                                <td>{{ $application->approval_status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
