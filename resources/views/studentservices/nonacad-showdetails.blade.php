@extends('membership.dashboard')

@section('content')
    <div class="mt-3">
         {{-- Title and Breadcrumbs --}}
         <div class="d-flex justify-content-between align-items-center">
           
            {{-- Breadcrumbs --}}
            <nav aria-label="breadcrumb align-items-center">
                <ol class="breadcrumb justify-content-center ">
                    
                    <li class="breadcrumb-item active" aria-current="page">
                        Members /  Official Member / Member Details
                    </li>
                    <li class="breadcrumb-item">
                        <a href="" class="text-decoration-none">Back</a>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="card">
            <div class=" card-header text-light" style="background-color: #c62128">{{ __("Members Profile") }}</div>
            <div class="card-body">
                <form>
                    <div class="form-group row mb-2">
                        <label for="last_name"
                            class="col-md-4 col-form-label text-md-right">{{ __('Student Number') }}</label>

                        <div class="col-md-6">
                            <input id="student_number" type="text"
                                class="form-control @error('student_number') is-invalid @enderror"
                                name="student_number" value="{{ $member_detail->student_number }}" required
                                autocomplete="student_number" autofocus readonly>
                            @error('student_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="first_name"
                            class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                        <div class="col-md-6">
                            <input id="first_name" type="text"
                                class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                value="{{ $member_detail->first_name }}" required autocomplete="first_name"
                                autofocus readonly>

                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="middle_name"
                            class="col-md-4 col-form-label text-md-right">{{ __('Middle Name') }}</label>

                        <div class="col-md-6">
                            <input id="middle_name" type="text"
                                class="form-control @error('middle_name') is-invalid @enderror" name="middle_name"
                                value="{{ $member_detail->middle_name }}" required autocomplete="middle_name"
                                autofocus readonly>

                            @error('middle_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="last_name"
                            class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                        <div class="col-md-6">
                            <input id="last_name" type="text"
                                class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                value="{{ $member_detail->last_name }}" required autocomplete="last_name"
                                autofocus readonly>

                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="last_name"
                            class="col-md-4 col-form-label text-md-right">{{ __('Suffix') }}</label>

                        <div class="col-md-6">
                            <input id="suffix" type="text"
                                class="form-control @error('suffix') is-invalid @enderror" name="suffix"
                                value="{{ $member_detail->suffix }}" required autocomplete="suffix"
                                autofocus readonly>

                            @error('suffix')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="address"
                            class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                        <div class="col-md-6">
                            <input id="address" type="text"
                                class="form-control @error('address') is-invalid @enderror"
                                name="address" value="{{ $member_detail->address }}" required
                                autocomplete="address" autofocus readonly>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="course_id"
                            class="col-md-4 col-form-label text-md-right">{{ __('Course') }}</label>

                        <div class="col-md-6">
                            <select name="course_id" class="form-control" disabled>
                                <option value="">{{ 'Choose' }}</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->course_id }}"
                                        {{ $course->course_id == $member_detail->course_id ? 'selected' : '' }}
                                        @error('course_id') is-invalid @enderror>
                                        {{ $course->course_name }}</option>
                                @endforeach
                            </select>

                            @error('course')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="year_and_section"
                            class="col-md-4 col-form-label text-md-right">{{ __('Year and Section') }}</label>
                        <div class="col-md-6">
                            <input id="year_and_section" type="text"
                                class="form-control @error('year_and_section') is-invalid @enderror"
                                name="year_and_section" value="{{ $member_detail->year_and_section }}" readonly required>
                            @error('year_and_section')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="mobile_number"
                            class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>

                        <div class="col-md-6">
                            <input id="mobile_number" type="text"
                                class="form-control @error('mobile_number') is-invalid @enderror"
                                name="mobile_number" value="{{ $member_detail->contact }}"  readonly required>
                            @error('mobile_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="email"
                            class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ $member_detail->email }}" readonly required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="date_of_birth"
                            class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                        <div class="col-md-6">
                            <input id="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                                name="date_of_birth" value="{{ $member_detail->date_of_birth }}"readonly required autocomplete="date_of_birth">

                            @error('date_of_birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="membership_status"
                            class="col-md-4 col-form-label text-md-right">{{ __('Membership Status') }}</label>

                        <div class="col-md-6">
                            <input id="membership_status" type="text" class="form-control @error('membership_status') is-invalid @enderror"
                                name="membership_status" value="{{ $member_detail->membership_status }}" readonly required autocomplete="membership_status">

                            @error('membership_status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
