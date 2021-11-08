@extends('membership.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit User') }}</div>
                    <div class="card-body">
                        <form class="row g-3" method="POST"
                            action="{{ route('membership.admin.users.update', $user->user_id) }}">
                            @method('PATCH')
                            @include('admin.users.includes.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
