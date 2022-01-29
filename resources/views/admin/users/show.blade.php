@extends('membership.dashboard')

@section('content')
{{-- Title and Breadcrumbs --}}
<div class="d-flex justify-content-between align-items-center">
                
    {{-- Breadcrumbs --}}
    <nav aria-label="breadcrumb align-items-center">
        <ol class="breadcrumb justify-content-center ">
            
            <li class="breadcrumb-item active" aria-current="page">
                Organization / User Management / User Details
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('membership.admin.academic.users.index')}}" class="text-decoration-none">Back</a>
            </li>
        </ol>
    </nav>
</div>
<div class="card">
    <div class="card-header">{{ __('Show User Details') }}</div>
    <div class="card-body">
        <form class="row g-3">
           
            <div class="col-md-3 mb-2">
                <label for="first_name" class="form-label">{{ __('First Name') }}<span style="color:red">*</span></label>
                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                    value="{{ old('first_name') }}@isset($user){{ $user->first_name }}@endisset" readonly
                    autocomplete="first_name" autofocus>

                @error('first_name')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-md-3 mb-2">
                <label for="middle_name" class="form-label">{{ __('Middle Name') }}</label>
                <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror"
                    name="middle_name" value="{{ old('middle_name') }}@isset($user){{ $user->middle_name }}@endisset"
                    autocomplete="middle_name" autofocus readonly>

                @error('middle_name')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div class="col-md-3 mb-2">
                <label for="last_name" class="form-label">{{ __('Last Name') }}<span style="color:red">*</span></label>
                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                    value="{{ old('last_name') }}@isset($user){{ $user->last_name }}@endisset" readonly
                    autocomplete="last_name" autofocus>

                @error('last_name')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-3 mb-2">
                <label for="suffix" class="form-label">{{ __('Suffix') }}</label>
                <input id="suffix" type="text" class="form-control @error('last_name') is-invalid @enderror" name="suffix"
                    value="{{ old('suffix') }}@isset($user){{ $user->suffix }}@endisset"
                    autocomplete="suffix" autofocus readonly>

                @error('suffix')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-4 mb-2">
                <label for="last_name" class="form-label">{{ __('Student Number') }}</label>
                <input id="student_number" type="text" class="form-control @error('student_number') is-invalid @enderror"
                    name="student_number" value="{{ old('student_number') }}@isset($user){{ $user->student_number }}@endisset"
                    autocomplete="student_number" autofocus readonly>
                @error('student_number')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-4 mb-2">
                <label for="email" class="form-label">{{ __('E-Mail Address') }}<span style="color:red">*</span></label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}  @isset($user){{ $user->email }}@endisset" readonly autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
            <div class="col-md-4 mb-2">
                <label for="year_and_section" class="form-label">{{ __('Year and Section') }}</label>
                <input id="year_and_section" type="text" class="form-control @error('year_and_section') is-invalid @enderror"
                    name="year_and_section" readonly
                    value="{{ old('year_and_section') }}@isset($user){{ $user->year_and_section }}@endisset">

                @error('year_and_section')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-6 mb-2">
                <label for="course_id" class="form-label">{{ __('Course') }}</label>
                <select name="course_id" class="form-control @error('course_id') is-invalid @enderror" readonly>

                    @foreach ($courses as $course)
                        <option value="{{ $course->course_id }}" @isset($user){{ $course->course_id == $user->course_id ? 'selected' : '' }} @endisset>
                            {{ $course->course_name }}
                        </option>
                    @endforeach
                </select>

                @error('course')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div class="col-md-6 mb-2">
                <label for="address" class="form-label">{{ __('Address') }}<span style="color:red">*</span></label>
                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                    name="address" readonly
                    value="{{ old('address') }}@isset($user){{ $user->address }}@endisset">

                @error('address')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-md-4 mb-2">
                <label for="gender" class="form-label ">{{ __('Gender') }}<span style="color:red">*</span></label>
                <select aria-label="Default select example" name="gender" class="form-control @error('gender') is-invalid @enderror"
                    value="{{ old('gender') }}@isset($user){{ $user->gender }}@endisset" readonly>
                    @foreach ($genders as $gender)
                        <option value="{{ $gender->gender_id }}" @isset($user){{ $gender->gender_id == $user->gender_id ? 'selected' : '' }} @endisset>
                            {{ $gender->gender }}
                        </option>
                    @endforeach
                </select>
                @error('gender')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div class="col-md-4 mb-2">
                <label for="date_of_birth" class="form-label">{{ __('Date of Birth') }}<span style="color:red">*</span></label>
                <input id="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                    name="date_of_birth" value="{{ old('date_of_birth') }}@isset($user){{ $user->date_of_birth }}@endisset"
                    readonly>
                @error('date_of_birth')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-4 mb-2">
                <label for="mobile_number" class="form-label">{{ __('Mobile Number') }}<span style="color:red">*</span></label>
                <input id="mobile_number" type="text" class="form-control @error('mobile_number') is-invalid @enderror"
                    name="mobile_number" value="{{ old('mobile_number') }}@isset($user){{ $user->mobile_number }}@endisset"
                   readonly>
                @error('mobile_number')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </form>
    </div>
</div> 
            
@endsection
