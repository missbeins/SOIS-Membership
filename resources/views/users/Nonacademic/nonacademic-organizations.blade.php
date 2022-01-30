@extends('membership.dashboard')

@section('content')

    <div class="card">
        <div class=" card-header text-light" style="background-color: #c62128">Non-academic Organizations</div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <th>@sortablelink('organization_name','Organization')</th>
                    <th>@sortablelink('membership_start_date','Start Date')</th>
                    <th>@sortablelink('membership_start_date','End Date')</th>
                    <th>@sortablelink('nam_status','Status')</th>
                </thead>
                <tbody>
                    @foreach ($organizations as $organization)
                        <tr>
                            <td>{{ $organization->organization_name }}</td>
                            <td>{{ $organization->membership_start_date }}</td>
                            <td>{{ $organization->membership_end_date }}</td>
                            @if ($organization->am_status == 'Close' || $organization->am_status == 'close')
                                <td class="text-danger">{{ $organization->nam_status }}</td>
                            @else
                                <td class="text-success">{{ $organization->nam_status }}</td>
                            @endif
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
