@extends('membership.dashboard')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1>Verify e-mail address</h1>
                        <p>Please verify your e-mail address first.</p>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('verification.send') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success"> Resend Verification E-mail</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
