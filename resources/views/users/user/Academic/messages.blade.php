@extends('membership.dashboard')

@section('content')

    <div class="container">
        <h3>Messages</h3>
        {{-- @foreach ($membership as $member) --}}
            <div class="card text-dark bg-light mb-3">
                <div class=" card-header text-light" style="background-color: #c62128">Organizations</div>
                <div class="card-body">
                    @if (isset($messages))
                        <table class="table table-striped">
                            
                            <thead>
                                <th class="col-md-1">#</th>
                                <th class="col-md-2">Organization</th>
                                <th class="col-md-5">Message</th>
                                <th class="col-md-1">Action</th>
                            </thead>
                            <tbody>
                                @if ($messages->isNotEmpty())
                                    @foreach ($messages as $message)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $message->organization_name }}</td>
                                            <td>{{ $message->message }}</td>
                                            <td>
                                                <a href="" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="view details"><i class="fas fa-eye" ></i></a>
                                                <a href="" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="delete message"><i class="fas fa-trash" ></i></a>

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
        {{-- @endforeach --}}
    </div>
@endsection
