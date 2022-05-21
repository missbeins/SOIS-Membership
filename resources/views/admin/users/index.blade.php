@extends('membership.dashboard')

@section('content')
    {{-- @if (isset($errors) && $errors->any())
        <div class="alert alert-danger mt-2">
            @foreach ($errors->all() as $error )
                {{ $error }}
            @endforeach
        </div>
    @endif --}}
    <div class="container-fluid" >   
        <div class="mt-3">
            {{-- Title and Breadcrumbs --}}
            <div class="d-flex justify-content-between align-items-center">
                
                {{-- Breadcrumbs --}}
                <nav aria-label="breadcrumb align-items-center">
                    <ol class="breadcrumb justify-content-center ">
                        
                        <li class="breadcrumb-item active" aria-current="page">
                            Organization / User Management 
                        </li>

                    </ol>
                </nav>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="float-left">User Management</h4>
                            <a role="button" class="btn btn-sm btn-success float-right"
                                href="{{ route('membership.admin.academic.users.create') }}">
                                New User
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive text-center">
                    <table class="table table-hover table-striped table-bordered table-light" id="users">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Student Number</th>
                                <th scope="col">Email</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($users->isNotEmpty())
                                @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $user->student_number }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <a role="button" class="btn btn-sm btn-primary"
                                                href="{{ route('membership.admin.academic.users.edit', $user->user_id) }}">
                                                <i class="fas fa-user-edit"></i> Edit
                                            </a>
                                            <a role="button" class="btn btn-sm btn-info"
                                            href="{{ route('membership.admin.academic.users.show', $user->user_id) }}">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                            {{-- <button type="button" class="btn btn-sm btn-danger"
                                                onclick="event.preventDefault(); document.getElementById('delete-user-form-{{ $user->user_id }}').submit()">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                            <form class="d-none" id="delete-user-form-{{ $user->user_id }}"
                                                action="{{ route('membership.admin.users.destroy', $user->user_id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="4">No results found!</td></tr>
                           @endif
                        </tbody>
                    </table>
                   {{-- {{ $users->links() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{-- Import Datatables --}}
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
@endpush

@section('scripts')
    <script type="module">
        // Simple-DataTables
        // https://github.com/fiduswriter/Simple-DataTables
        window.addEventListener('DOMContentLoaded', event => {
            const dataTable = new simpleDatatables.DataTable("#users", {
                perPage: 5,
                searchable: true,
                labels: {
                    placeholder: "Search on current page...",
                    noRows: "No data to display in this page or try in the next page.",
                },
            });
        });
    </script>
@endsection