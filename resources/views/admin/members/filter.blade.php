@extends('membership.dashboard')

@section('content')
<div class="mt-3">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-8">
                    <h4 class="float-left">Official Members</h4>
                </div>
                <form class="col-md-4 input-group" style="width:30%" action="{{ route('membership.admin.member-filter') }}" method="get">
                   @csrf
                            <label class="input-group-text" for="inputGroupSelect01">{{ __('Filter') }}</label>
                            <select class="form-control @error('query') is-invalid @enderror" id="inputGroupSelect01" name="query">
                                @foreach ($academic_memberships as $academic_membership)
                                    <option value="{{ $academic_membership->academic_membership_id }}">{{ $academic_membership->semester }}({{ $academic_membership->school_year }})</option>                          
                                @endforeach
                            </select>                        
                                    @error('query')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            <button class="input-group-text btn-secondary"type="submit">Enter</button>
                   
                </form>
            </div>
        </div>
        <div class="card-body table-responsive text-center">
            @if (isset($paidmembers))
                <table class="table table-light table-sm table-striped table-hover">
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
                        @if ($paidmembers->isNotEmpty())
                            @foreach ($paidmembers as $member)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $member->last_name }}, {{ $member->first_name }} {{ $member->middle_name }}</td>
                                    <td>{{ $member->email }}</td>
                                    <td>{{ $member->gender }}</td>
                                    <td>{{ $member->year_and_section }}</td>
                                    <td>{{ $member->contact }}</td>
                                    <td>
                                        <button class="btn btn-secondary btn-sm"><i class="fas fa-bell"> Message</i></button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                                <tr><td colspan="7">No results found!</td></tr>
                        @endif
                    </tbody>
                </table>
                {{ $paidmembers->links() }}
            @endif
            
        </div>
    </div>
</div>
@endsection
