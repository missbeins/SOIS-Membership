@extends('membership.dashboard')

@section('content')

{{-- Title and Breadcrumbs --}}
<div class="d-flex justify-content-between align-items-center">
    
    {{-- Breadcrumbs --}}
    <nav aria-label="breadcrumb align-items-center">
        <ol class="breadcrumb justify-content-center ">
            
            <li class="breadcrumb-item active" aria-current="page">
                User / Messages / Sents
            </li>

        </ol>
    </nav>
</div>

<div class="card text-dark bg-light mb-3">
    <div class=" card-header text-light" style="background-color: #c62128"><h3>Sents</h3></div>
    <div class="card-body">
        @if (isset($messages))
            <table class="table table-striped">
                
                <thead>
                    <th class="col-md-1">#</th>
                    <th class="col-md-3">Organization</th>
                    <th class="col-md-5">Message</th>
                    <th class="col-md-3">Action</th>
                </thead>
                <tbody>
                    @if ($messages->isNotEmpty())
                        @foreach ($messages as $message)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $message->organization_name }}</td>
                                <td>{{ $message->message }}</td>
                                <td>
                                    <!-- Button trigger accept modal -->
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#viewmessage">
                                        <i class="fas fa-eye"></i> View
                                    </button>
                                    @include('users.Academic.includes.view-message')
                                    <!-- Button trigger accept modal -->
                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#replymessage">
                                        <i class="fas fa-reply"></i> Reply
                                    </button>
                                    @include('users.Academic.includes.reply-message')
                                    <!-- Button trigger accept modal -->
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletemessage">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                    @include('users.Academic.includes.delete-message')
                                </td>
                                
                            </tr>
                        @endforeach
                    @else
                        <tr><td class="text-center" colspan="7">No results found!</td></tr>
                    @endif
                    
                </tbody>
            </table>
        @endif
    </div>
</div>


@endsection
