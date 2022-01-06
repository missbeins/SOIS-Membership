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
                                <option selected>Choose membership...</option>
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
       
            <table class="table table-light table-sm table-striped table-hover">
                <thead>
                    <tr>
                        
                        <th class="col-sm-2">Membership <br><small class="text-primary"> Semester ( yyyy-mm-dd )</small></th>
                        <th class="col-sm-2">Name</th>
                        <th class="col-sm-1">Year and Section</th>
                        <th class="col-sm-1">Contact</th>
                        <th class="col-sm-1">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($paidmembers as $member)
                        <tr>
                           
                            <td>{{ $member->semester }}({{ $member->membership_start_date }} to {{ $member->membership_end_date }})</td>
                            <td>{{ $member->first_name }} {{ $member->middle_name }} {{ $member->last_name }}</td>
                            <td>{{ $member->year_and_section }}</td>
                            <td>{{ $member->contact }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $member->academic_member_id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="message"><i class="fas fa-comments"></i></button>
                                @include('admin.members.includes.message')  
                                <a href="{{ route('membership.admin.official.show', $member->academic_member_id) }}" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="view details"><i class="fas fa-eye" ></i></a>
                            </td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
