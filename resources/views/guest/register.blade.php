@extends('layouts.navbar')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Account Registration') }}</div>
                    <div class="card-body">
                        <form class="row g-3" method="POST" action="{{ route('information-verify') }}">
                            @csrf
                            <div class="col-lg-3 mb-2">
                                <label for="first_name" class="form-label">{{ __('First Name') }}<span style="color:red">*</span></label>
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                    value="{{ old('first_name') }}"required
                                    autocomplete="first_name" autofocus>
                            
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="col-lg-3 mb-2">
                                <label for="middle_name" class="form-label">{{ __('Middle Name') }}</label>
                                <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror"
                                    name="middle_name" value="{{ old('middle_name') }}"
                                    autocomplete="middle_name" autofocus>
                            
                                @error('middle_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            
                            <div class="col-lg-3 mb-2">
                                <label for="last_name" class="form-label">{{ __('Last Name') }}<span style="color:red">*</span></label>
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                    value="{{ old('last_name') }}" required
                                    autocomplete="last_name" autofocus>
                            
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-3 mb-2">
                                <label for="suffix" class="form-label">{{ __('Suffix') }}</label>
                                <input id="suffix" type="text" class="form-control @error('suffix') is-invalid @enderror" name="suffix"
                                    value="{{ old('suffix') }}"
                                    autocomplete="suffix" autofocus>
                            
                                @error('suffix')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-12 mb-2">
                                <label for="inputAddress" class="form-label">Address<span style="color:red">*</span></label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="inputAddress" placeholder="1234 Main St"
                                    name="address" required>
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            </div>
                            <div class="col-lg-4 mb-2">
                                <label for="last_name" class="form-label">{{ __('Student Number') }}<span style="color:red">*</span></label>
                                <input id="student_number" type="text" class="form-control @error('student_number') is-invalid @enderror"
                                    name="student_number" value="{{ old('student_number') }}"
                                    required autocomplete="student_number" pattern="[0-9]{4}-[0-9]{5}-[A-Z]{2}-[0]{1}" autofocus>
                                    <small>Format: 2019-00000-TG-0</small>
                                @error('student_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4 mb-2">
                                <label for="email" class="form-label">{{ __('E-Mail Address') }}<span style="color:red">*</span></label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">
                            
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            
                            <div class="col-lg-4 mb-2">
                                <label for="course_id" class="form-label">{{ __('Course') }}<span style="color:red">*</span></label>
                                <select name="course_id" class="form-control @error('course_id') is-invalid @enderror">
                        
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->course_id }}">
                                            {{ $course->course_name }}</option>
                                    @endforeach
                                </select>
                        
                                @error('course')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        
                            <div class="col-lg-3 mb-2">
                                <label for="year_and_section" class="form-label">{{ __('Year and Section') }}<span style="color:red">*</span></label>
                                <input id="year_and_section" type="text" class="form-control @error('year_and_section') is-invalid @enderror"
                                    name="year_and_section"
                                    value="{{ old('year_and_section') }}" pattern="[0-5]{1}-[0-9]{1}"required>
                                    <small>Format: Year-Section (4-1)</small>
                                @error('year_and_section')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="col-lg-3 mb-2">
                                <label for="gender" class="form-label ">{{ __('Gender') }}<span style="color:red">*</span></label>
                                <select aria-label="Default select example" name="gender" class="form-control @error('gender') is-invalid @enderror"
                                    value="{{ old('gender') }}" required>
                                    @foreach ($genders as $gender)
                                        <option value="{{ $gender->gender_id }}">{{ $gender->gender }}</option>
                                    @endforeach

                                </select>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                        
                            <div class="col-lg-3 mb-2">
                                <label for="date_of_birth" class="form-label">{{ __('Date of Birth') }}<span style="color:red">*</span></label>
                                <input id="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}"
                                    required>
                                @error('date_of_birth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-3 mb-2">
                                <label for="mobile_number" class="form-label">{{ __('Mobile Number') }}<span style="color:red">*</span></label>
                                <input id="mobile_number" type="text" class="form-control @error('mobile_number') is-invalid @enderror"
                                    name="mobile_number" value="{{ old('mobile_number') }}"
                                    required>
                                @error('mobile_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                                <div class="col-lg-6 mb-2">
                                    <label for="password" class="form-label">{{ __('Password') }}<span style="color:red">*</span></label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">
                        
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}<span style="color:red">*</span></label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                                        autocomplete="new-password">
                                </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
