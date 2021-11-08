@extends('membership.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>
                    <div class="card-body">
                        <form class="row g-3" method="POST" action="{{ route('membership.admin.users.store') }}">
                            @include('admin.users.includes.form',['create' => true])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
