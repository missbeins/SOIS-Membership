@extends('membership.dashboard')

@section('content')
    <div class="container mt-3">
        <div class="card text-center">
            <div class="card-header">
                Membership
            </div>
            <div class="card-body">
                <h5 class="card-title">Welcome Back
                    {{-- @if (Auth::user()->gender)
                        Mr. {{ Auth::user()->first_name }} {{ Auth::user()->middle_name }}
                        {{ Auth::user()->last_name }}
                    @else
                        Ms. {{ Auth::user()->first_name }} {{ Auth::user()->middle_name }}
                        {{ Auth::user()->last_name }}
                    @endif --}}
                </h5>
                <p class="card-text">Welcome to PUP - Taguig Student Organizations Information System. A place to manage
                    your organization's membership. </p>
                @can('is-admin')
                    <a href="{{ route('membership.admin.users.index') }}" class="btn btn-primary">Get started</a>
                @elsecan('is-student')
                    <a href="{{ route('membership.user.academic.my-organizations') }}" class="btn btn-success">Get started</a>
                @endcan

            </div>
            <div class="card-footer text-muted">

            </div>
        </div>
    </div>
@endsection
