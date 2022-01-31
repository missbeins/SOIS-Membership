@extends('membership.dashboard')

@section('content')
    {{-- Title and Breadcrumbs --}}
<div class="d-flex justify-content-between align-items-center">
    
    {{-- Breadcrumbs --}}
    <nav aria-label="breadcrumb align-items-center">
        <ol class="breadcrumb justify-content-center ">
            
            <li class="breadcrumb-item active" aria-current="page">
                Organizations / Non Academic Organizations
            </li>

        </ol>
    </nav>
</div>
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
                    @if ($organizations->isNotEmpty())

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
                    @else
                    <tr><td colspan="4">No results found!</td></tr>
                   @endif
                </tbody>
            </table>
            {!! $organizations->appends(Request::except('page'))->render() !!}
            <p class="text-center">
                Displaying {{$organizations->count()}} of {{ $organizations->total() }} organizations.
            </p>
        </div>
    </div>

@endsection
