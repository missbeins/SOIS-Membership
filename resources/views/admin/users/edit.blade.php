@extends('membership.dashboard')

@section('content')
{{-- Title and Breadcrumbs --}}
<div class="d-flex justify-content-between align-items-center">
                
    {{-- Breadcrumbs --}}
    <nav aria-label="breadcrumb align-items-center">
        <ol class="breadcrumb justify-content-center ">
            
            <li class="breadcrumb-item active" aria-current="page">
                Organization / User Management / Edit User
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('membership.admin.academic.users.index')}}" class="text-decoration-none">Back</a>
            </li>
        </ol>
    </nav>
</div>
<div class="card">
    <div class="card-header">{{ __('Edit User') }}</div>
    <div class="card-body">
        <form class="row g-3" method="POST"
            action="{{ route('membership.admin.academic.users.update', $user->user_id) }}">
            @method('PUT')
            @include('admin.users.includes.form')
        </form>
    </div>
</div> 
            
@endsection
