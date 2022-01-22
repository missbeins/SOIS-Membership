@extends('membership.dashboard')

@section('content')
{{-- Title and Breadcrumbs --}}
<div class="d-flex justify-content-between align-items-center">
    
    {{-- Breadcrumbs --}}
    <nav aria-label="breadcrumb align-items-center">
        <ol class="breadcrumb justify-content-center ">
            
            <li class="breadcrumb-item active" aria-current="page">
                Organizations / Academic Organizations
            </li>

        </ol>
    </nav>
</div>
<div class="card">
    <div class=" card-header text-light" style="background-color: #c62128">Academic Organizations</div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <th>Organization</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
            </thead>
            <tbody>
                @foreach ($organizations as $organization)
                    <tr>
                        <td>{{ $organization->organization_name }}</td>
                        <td>{{ $organization->membership_start_date }}</td>
                        <td>{{ $organization->membership_end_date }}</td>
                        @if ($organization->am_status == 'Close' || $organization->am_status == 'close')
                            <td class="text-danger">{{ $organization->am_status }}</td>
                        @else
                            <td class="text-success">{{ $organization->am_status }}</td>
                        @endif
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
