@extends('membership.dashboard')

@section('content')
 {{-- Title and Breadcrumbs --}}
<div class="d-flex justify-content-between align-items-center">
                
    {{-- Breadcrumbs --}}
    <nav aria-label="breadcrumb align-items-center">
        <ol class="breadcrumb justify-content-center ">
            
            <li class="breadcrumb-item active" aria-current="page">
                User / Head of Student Services Profile
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('membership.student-services.academicOrgs') }}" class="text-decoration-none">Home</a>
            </li>

        </ol>
    </nav>
</div>
<form action="{{ route('membership.student-services.update-profile', $user_id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="card">
        <div class="card-header">{{ __('Update Profile') }}
            <button type="submit" class="btn btn-success btn-sm float-end">Save</button>
        </div>
        <div class="card-body">
                <div class="row g-2 mb-2">
                    <div class="col-md">
                        <label for="first_name">First Name</label>
                        <div class="form-floating" id="first_name">
                            <input type="text" class="form-control" id="floatingInputGrid" placeholder="name@example.com" value="{{ Auth::user()->first_name }}" name="first_name">
                            <label for="floatingInputGrid">Input your Firstname</label>
                        </div>
                        @error('first_name')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="col-md">
                        <label for="middle_name">Middle Name</label>
                        <div class="form-floating" id="middle_name">
                            <input type="text" class="form-control" id="floatingInputGrid" placeholder="name@example.com" value="{{ Auth::user()->middle_name }}" name="middle_name">
                            <label for="floatingInputGrid">Input your Middlename</label></label>
                        </div>
                        @error('middle_name')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    
                    <div class="col-md">
                        <label for="last_name">Last Name</label>
                        <div class="form-floating" id="last_name">
                            <input type="text" class="form-control" id="floatingInputGrid" placeholder="name@example.com" value="{{ Auth::user()->last_name }}" name="last_name">
                            <label for="floatingInputGrid">Input your Lastname</label>
                        </div>
                        @error('last_name')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="col-md-2">
                        <label for="suffix">Suffix</label>
                        <div class="form-floating" id="suffix">
                            <input type="text" class="form-control" id="floatingInputGrid" value="{{ Auth::user()->suffix }}" name="suffix">
                            <label for="floatingInputGrid">Input your suffix</label>
                        </div>
                        @error('suffix')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row g-2 mb-2">
                    <div class="col-md-6">
                        <label for="email">Email</label>
                        <div class="form-floating" id="email">
                            <input type="email" class="form-control" id="floatingInputGrid" placeholder="name@example.com" value="{{ Auth::user()->email }}" name="email">
                            <label for="floatingInputGrid">Input your Email</label>
                        </div>
                        @error('email')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="contact">Contact</label>
                        <div class="form-floating" id="contact">
                            <input type="text" class="form-control" id="floatingInputGrid"value="{{ Auth::user()->mobile_number }}" name="mobile_number">
                            <label for="floatingInputGrid">Input your Contact Number</label></label>
                        </div>
                        @error('mobile_number')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="gender">Gender</label>
                        <div class="form-floating" id="gender">
                            <select class="form-select" id="gender_id" aria-label="Floating label select example" name="gender_id">
                                @foreach ($genders as $gender)
                                    <option value="{{ $gender->gender_id }}" {{ $gender->gender_id  == auth()->user()->gender_id ? 'selected' : '' }}>
                                        {{ $gender->gender }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="gender_id">Input your Gender</label>
                        </div>
                        @error('gender_id')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
        </div>
    </div>
</form>

@endsection
