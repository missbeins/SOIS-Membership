@csrf
<div class="col-md-3 mb-2">
    <label for="first_name" class="form-label">{{ __('First Name') }}<span style="color:red">*</span></label>
    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name"
        value="{{ old('first_name') }}@isset($user){{ $user->first_name }}@endisset" required
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
        autocomplete="middle_name" autofocus>

    @error('middle_name')
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>


<div class="col-md-3 mb-2">
    <label for="last_name" class="form-label">{{ __('Last Name') }}<span style="color:red">*</span></label>
    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name"
        value="{{ old('last_name') }}@isset($user){{ $user->last_name }}@endisset" required
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
        autocomplete="suffix" autofocus>

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
        autocomplete="student_number" autofocus>
    @error('student_number')
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="col-md-4 mb-2">
    <label for="email" class="form-label">{{ __('E-Mail Address') }}<span style="color:red">*</span></label>
    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
        value="{{ old('email') }}  @isset($user){{ $user->email }}@endisset" required autocomplete="email">

        @error('email')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
</div>
<div class="col-md-4 mb-2">
    <label for="year_and_section" class="form-label">{{ __('Year and Section') }}</label>
    <input id="year_and_section" type="text" class="form-control @error('year_and_section') is-invalid @enderror"
        name="year_and_section"
        value="{{ old('year_and_section') }}@isset($user){{ $user->year_and_section }}@endisset">

    @error('year_and_section')
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="col-md-6 mb-2">
    <label for="course_id" class="form-label">{{ __('Course') }}</label>
    <select name="course_id" class="form-control @error('course_id') is-invalid @enderror">

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
        name="address"
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
        value="{{ old('gender') }}@isset($user){{ $user->gender }}@endisset" required>
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
        required>
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
        required>
    @error('mobile_number')
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

@isset($create)

    <div class="col-md-6 mb-2">
        <label for="password" class="form-label">{{ __('Password') }}<span style="color:red">*</span></label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
            required autocomplete="new-password">

        @error('password')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div> 



    <div class="col-md-6 mb-2">
        <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}<span style="color:red">*</span></label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
            autocomplete="new-password">
    </div>
    {{-- <div class="col-6 mb-2">
        <label for="roles" class="form-label text-md-right">{{ __('Role') }}</label>
        @foreach ($roles as $role)
            <div class="form-check">
                <input class="form-check-input" type="radio" name="roles" value="{{ $role->role_id }}"
                    id="{{ $role->role }}" @isset($user)@if (in_array($role->role_id, $user->roles->pluck('role_id')->toArray())) checked @endif @endisset>
                <label class="form-check-label" for="{{ $role->role }}">
                    {{ $role->role }}
                </label>
            </div>
        @endforeach
    </div> --}}

@endisset
<div class="col-md-12">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
