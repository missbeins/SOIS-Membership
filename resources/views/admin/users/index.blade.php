@extends('membership.dashboard')

@section('content')
    <div class="container-fluid px-2">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="cardcon p-3 bg-white d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2 text-center">{{ $members }}</h3>
                        <p class="fs-5">Members</p>
                    </div>
                    <i class="fas fa-users fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </div>
            <div class="col-md-4">
                <div class="cardcon p-3 bg-white d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2 text-center">{{ $applications }}</h3>
                        <p class="fs-5">Application Requests</p>
                    </div>
                    <i class="fas fa-address-book fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </div>

            <div class="col-md-4">
                <div class="cardcon p-3 bg-white  d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2 text-center">{{ $unpaid_members }}</h3>
                        <p class="fs-5">Unpaid Members</p>
                    </div>
                    <i class="fas fa-hand-holding-usd fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="float-left">User Management</h3>
                        <a role="button" class="btn btn-sm btn-success float-right"
                            href="{{ route('membership.admin.users.create') }}">
                            New
                        </a>
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            Import
                        </button>
                        @include('admin.users.includes.import')
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive  text-center">
                <table class="table table-hover table-striped table-bordered table-light">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Student Number</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $user->student_number }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a role="button" class="btn btn-sm btn-primary"
                                        href="{{ route('membership.admin.users.edit', $user->user_id) }}">
                                        <i class="fas fa-user-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger"
                                        onclick="event.preventDefault(); document.getElementById('delete-user-form-{{ $user->user_id }}').submit()">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    <form class="d-none" id="delete-user-form-{{ $user->user_id }}"
                                        action="{{ route('membership.admin.users.destroy', $user->user_id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>

    </div>
@endsection
