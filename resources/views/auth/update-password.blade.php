@extends('membership.dashboard')

@section('content')
{{-- Title and Breadcrumbs --}}
<div class="d-flex justify-content-between align-items-center">
                
    {{-- Breadcrumbs --}}
    <nav aria-label="breadcrumb align-items-center">
        <ol class="breadcrumb justify-content-center ">
            
            <li class="breadcrumb-item active" aria-current="page">
                Organization / User Profile / Change Password
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('membership.admin.academicmembership.index')}}" class="text-decoration-none">Home</a>
            </li>

        </ol>
    </nav>
</div>
<div class="card">
    <div class="card-header">{{ __('Change Password') }}</div>

    <div class="card-body">
        <form method="POST" action="{{ route('user-password.update') }}">
            @csrf
            @method('PUT')

            <div class="form-group row mb-2">
                <label for="current_password"
                    class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>

                <div class="col-md-6">
                    <input id="current_password" type="password"
                        class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                        name="current_password" required autofocus>

                    @error('current_password', 'updatePassword')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-2">
                <label for="password"
                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password"
                        class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                        name="password" required autocomplete="current-password">

                    @error('password', 'updatePassword')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="password_confirm"
                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password_confirm" type="password" class="form-control"
                        name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-5">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Save changes') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
           
@endsection
