@extends('membership.dashboard')

@section('content')
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </symbol>
</svg>
{{-- Title and Breadcrumbs --}}
<div class="d-flex justify-content-between align-items-center">
    
    {{-- Breadcrumbs --}}
    <nav aria-label="breadcrumb align-items-center">
        <ol class="breadcrumb justify-content-center ">
            
            <li class="breadcrumb-item active" aria-current="page">
                User / Messages / Sent
            </li>

        </ol>
    </nav>
</div>
@if (isset($errors) && $errors->any())
        <div class="alert alert-danger alert-dismissible mt-2">
            @foreach ($errors->all() as $error )
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                {{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            @endforeach
        </div>
@endif
<div class="card">
    <div class="card-header text-light" style="background-color: #c62128"><span style="font-size: 1.8rem; font-weight: 500">Sent</span>
        
        <button class="btn btn-warning btn-sm float-end" data-bs-toggle="modal" data-bs-target="#chooseyearlevel">
            <i class="fas fa-plus me-2"></i> New
        </button>
        @include('admin.messages.academic.includes.sent.choose-yearlevel')
    </div>
    <div class="card-body">
        @if (isset($membership_messages))
            <table class="table table-striped" id="sents">
                
                <thead>
                    <th class="col-md-3">Sent At</th>
                    <th class="col-md-3">Sent To</th>
                    
                    <th class="col-md-4">Message</th>
                    <th class="col-md-3">Action</th>
                </thead>
                <tbody>
                    @if ($membership_messages->isNotEmpty())
                        @foreach ($membership_messages as $message)
                            <tr>
                                <td>{{date_format(date_create($message->created_at), 'F d, Y' )   }}</td>
                                <td>{{ $message->first_name }} {{ $message->middle_name }} {{ $message->last_name }} {{ $message->suffix }}</td>
                                <td>{{Str::limit( $message->message, 50, $end='.......')}}</td>
                                <td>
                                    <!-- Button trigger accept modal -->
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#viewmessage{{ $message->message_id }}">
                                        <i class="fas fa-eye"></i> View
                                    </button>
                                    @include('admin.messages.academic.includes.sent.view-message')
                                    {{-- <!-- Button trigger accept modal -->
                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#replymessage">
                                        <i class="fas fa-reply"></i> Reply
                                    </button>
                                    @include('users.Academic.includes.reply-message') --}}
                                    {{-- <!-- Button trigger accept modal -->
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletemessage">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                    @include('users.Academic.includes.delete-message') --}}
                                </td>
                                
                            </tr>
                        @endforeach
                    @else
                        <tr><td class="text-center" colspan="7">No results found!</td></tr>
                    @endif
                    
                </tbody>
            </table>
           {{-- {{ $membership_messages->links() }} --}}
        @endif
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
            const dataTable = new simpleDatatables.DataTable("#sents", {
                // perPage: 10,
                searchable: true,
                labels: {
                    placeholder: "Search on current page...",
                    noRows: "No data to display in this page or try in the next page.",
                },
            });
        });
    </script>
@endsection

