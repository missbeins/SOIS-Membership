@extends('membership.dashboard')

@section('content')
<div class="mt-3">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-8">
                    <h4 class="float-left">Official Members</h4>
                </div>
                <div class="input-group col-md-4" style="width:30%">
                    <label class="input-group-text" for="inputGroupSelect01">Filter</label>
                    <select class="form-select" id="inputGroupSelect01">
                        @foreach ($academic_memberships as $academic_membership)
                            <option value="{{ $academic_membership->academic_membership_id }}">{{ $academic_membership->semester }}({{ $academic_membership->school_year }})</option>                          
                        @endforeach
                     
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive text-center">
       
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
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
