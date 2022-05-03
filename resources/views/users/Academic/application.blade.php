@extends('membership.dashboard')
@section('content')
<div class="container">
    {{-- Title and Breadcrumbs --}}
    <div class="d-flex justify-content-between align-items-center">
        
        {{-- Breadcrumbs --}}
        <nav aria-label="breadcrumb align-items-center">
            <ol class="breadcrumb justify-content-center ">
                
                <li class="breadcrumb-item active" aria-current="page">
                    Applications / Academic Organizations / Application form
                </li>
                <li class="breadcrumb-item">
                    <a href="{{route('membership.user.academic.my-applications')}}" class="text-decoration-none">Back</a>
                </li>
            </ol>
        </nav>
    </div>
    <div class="card">
        
        <div class="card-header">{{ __('Application Form') }}</div>
        <div class="card-body">
            <form class="row g-3" method="POST" action="{{ route('membership.user.academic.application-store') }}">
                @csrf
                                        
                <div class="col-md-3">
                    <label for="first_name" class="form-label">Firstname</label>
                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name"
                        value="{{ Auth::user()->first_name }}" required readonly>
                        @error('first_name')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="middle_name" class="form-label">Middlename</label>
                    <input type="text" class="form-control @error('middle_name') is-invalid @enderror" id="middle_name" name="middle_name"
                        value="{{ Auth::user()->middle_name }}" readonly>
                        @error('middle_name')
                        <span class="invalid-feedback  d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="last_name" class="form-label">Lastname</label>
                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name"
                        value="{{ Auth::user()->last_name }}" required readonly>
                        @error('last_name')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
                <div class="col-md-3">
                    <label for="suffix" class="form-label">Suffix</label>
                    <input type="text" class="form-control @error('suffix') is-invalid @enderror" id="suffix" name="suffix"
                        value="{{ Auth::user()->suffix }}" readonly>
                        @error('suffix')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Address</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="inputAddress" placeholder="1234 Main St"
                        name="address" value="{{ Auth::user()->address }}"required readonly>
                        @error('address')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
                <div class="col-7">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        value="{{ Auth::user()->email }}" name="email" required readonly>
                        @error('email')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
                <div class="col-5">
                    <label for="student_number" class="form-label">Student Number</label>
                    <input type="text" class="form-control @error('student_number') is-invalid @enderror" id="student_number" name="student_number"
                        value="{{ Auth::user()->student_number }}" pattern="[0-9]{4}-[0-9]{5}-[A-Z]{2}-[0]{1}" required readonly>
                        <small>Format: 2019-00000-TG-0</small>
                        @error('student_number')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
                <div class="col-md-6">
                    <label for="membership_id" class="form-label">Memberships</label>
                    <select id="membership_id" class="form-select" name="membership_id" required>
                        @foreach ($academic_memberships as $academic_membership)
                            <option value="{{ $academic_membership->academic_membership_id }}">{{ $academic_membership->semester }}({{ $academic_membership->membership_start_date }} to {{ $academic_membership->membership_end_date }})</option>
                            
                        @endforeach
                    </select>
                    @error('membership_id')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select id="gender" class="form-select" name="gender" disabled readonly>
                        @foreach(\App\Models\Gender::all() as $gender)
                            <option value="{{ $gender->gender_id }}" {{ $gender->gender_id  == auth()->user()->gender_id ? 'selected' : '' }}>
                                {{ $gender->gender }}
                            </option>
                        @endforeach
                    </select>
                    <input type="hidden" name="gender" value="{{ $gender->gender_id }}">
                    @error('gender')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="mobile_number" class="form-label">Contact</label>
                    <input type="text" class="form-control @error('mobile_number') is-invalid @enderror" id="mobile_number" name="mobile_number"
                        value="{{ Auth::user()->mobile_number }}" required readonly>
                    @error('mobile_number')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="course" class="form-label">Course</label>
                    <select id="course" class="form-select" name="course" disabled required>
                        <option value="{{ Auth::user()->course['course_id'] }}">
                            {{ Auth::user()->course['course_name'] }}
                        </option>
                    </select>
                    <input type="hidden" name="course" value="{{ Auth::user()->course_id}}">
                    @error('course')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="year_and_section" class="form-label">Year and section</label>
                    <input type="text" class="form-control @error('year_and_section') is-invalid @enderror" id="year_and_section" name="year_and_section" value="{{ Auth::user()->year_and_section}}" readonly required>

                    @error('year_and_section')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="date_of_birth" class="form-label">Date of birth</label>
                    <input type="date" class="form-control @error('student_number') is-invalid @enderror" id="date_of_birth" name="date_of_birth" value="{{ Auth::user()->date_of_birth}}" readonly required>
                    @error('date_of_birth')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
