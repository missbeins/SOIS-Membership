@extends('membership.dashboard')

@section('content')
{{-- Title and Breadcrumbs --}}
<div class="d-flex justify-content-between align-items-center">
       
    {{-- Breadcrumbs --}}
    <nav aria-label="breadcrumb align-items-center">
        <ol class="breadcrumb justify-content-center ">
            
            <li class="breadcrumb-item active" aria-current="page">
                Organization / Memberships / Details
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('membership.admin.nonacademic.memberships-reports')}}" class="text-decoration-none">Back</a>
            </li>

        </ol>
    </nav>
</div>
<div class="card">
    <div class="card-header">{{ __('Membership Details') }}</div>
    <div class="card-body">
        <form method="POST" action="{{ route('membership.admin.nonacademic.nonacademicmembership.update', [$nonacademic_membership->non_academic_membership_id, $nonacademic_membership->organization_id]) }}">
            @csrf
            @method('PUT')
            <div class=" mb-2 row"> 
                <div class="col-md-4">
                <label for="semester" class="form-label ">{{ __('Semester') }} </label>
                <select aria-label="Default select example" name="semester" class="form-control @error('semester') is-invalid @enderror"
                    value="{{ old('semester') }}" required readonly>
                    <option @isset($nonacademic_membership){{ $nonacademic_membership->semester == '1st Semester' ? 'selected' : '' }} @endisset>1st Semester</option>
                    <option @isset($nonacademic_membership){{ $nonacademic_membership->semester == '2nd Semester' ? 'selected' : '' }} @endisset>2nd Semester</option>
                </select>
                @error('semester')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="col-md-4">
                <label for="membership_fee" class="form-label">{{ __('Membership Fee') }}  </label>
                <input id="membership_fee" type="number" class="form-control @error('membership_fee') is-invalid @enderror"
                    name="membership_fee" value="{{ old('membership_fee') }}@isset($nonacademic_membership){{ $nonacademic_membership->membership_fee }}@endisset" required
                    autocomplete="membership_fee" autofocus readonly>

                @error('membership_fee')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
            
            
                <div class="col-md-4"> <label for="school_year" class="form-label">{{ __('School Year') }}  </label>
                <input id="school_year" type="text" class="form-control @error('school_year') is-invalid @enderror"
                    name="school_year" value="{{ old('school_year') }}@isset($nonacademic_membership){{ $nonacademic_membership->school_year }}@endisset" required
                    autocomplete="school_year" autofocus readonly>

                @error('school_year')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-2 row mt-2">
                <div class="col-md-6">
                    <label for="membership_start_date" class="form-label">{{ __('Membership Start Date') }} </label>
                    <input id="membership_start_date" type="date" class="form-control @error('membership_start_date') is-invalid @enderror" name="membership_start_date"
                        value="{{ old('membership_start_date') }}@isset($nonacademic_membership){{ $nonacademic_membership->membership_start_date }}@endisset" required
                        autocomplete="membership_start_date"readonly autofocus>
    
                    @error('membership_start_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                    <div class="col-md-6">
                    <label for="membership_end_date" class="form-label">{{ __('Membership End Date') }} </label>
                <input id="membership_end_date" type="date" class="form-control @error('membership_end_date') is-invalid @enderror" name="membership_end_date"
                    value="{{ old('membership_end_date') }}@isset($nonacademic_membership){{ $nonacademic_membership->membership_end_date }}@endisset" required
                    autocomplete="membership_end_date"readonly autofocus>

                @error('membership_end_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                    </div>
                </div>
            <div class="row mb-2">
                <div class="col-md-6">
                    <label for="registration_status" class="form-label ">{{ __('Registration Status') }} </label>
                    <select aria-label="Default select example" name="registration_status" class="form-control @error('registration_status') is-invalid @enderror"
                        value="{{ old('registration_status') }}"readonly required>
                        <option @isset($nonacademic_membership){{ $nonacademic_membership->registration_status == 'Open' ? 'selected' : '' }} @endisset>Open</option>
                        <option @isset($nonacademic_membership){{ $nonacademic_membership->registration_status == 'Closed' ? 'selected' : '' }} @endisset>Closed</option>
                    
                    </select>
                    @error('registration_status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                    <div class="col-md-6">
                    <label for="status" class="form-label ">{{ __('Status') }} </label>
                    <select aria-label="Default select example" name="status" class="form-control @error('status') is-invalid @enderror"
                        value="{{ old('status') }}"readonly required>
                        
                        <option @isset($nonacademic_membership){{ $nonacademic_membership->am_status == 'Active' ? 'selected' : '' }} @endisset>Active</option>
                        <option @isset($nonacademic_membership){{ $nonacademic_membership->am_status == 'Ended' ? 'selected' : '' }} @endisset>Ended</option>
                    
                    </select>
                    @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
            </div>
            <div class="mb-2 row">
                <div class="col-md-6">
                <label for="registration_start_date" class="form-label">{{ __('Registration Start Date') }} </label>
                <input id="registration_start_date" type="date" class="form-control @error('registration_start_date') is-invalid @enderror" name="registration_start_date"
                    value="{{ old('registration_start_date') }}@isset($nonacademic_membership){{ $nonacademic_membership->registration_start_date }}@endisset" required
                    autocomplete="registration_start_date"readonly autofocus>

                @error('registration_start_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="col-md-6">
                    <label for="registration_end_date" class="form-label">{{ __('Registration End Date') }} </label>
                <input id="registration_end_date" type="date" class="form-control @error('registration_end_date') is-invalid @enderror" name="registration_end_date"
                    value="{{ old('registration_end_date') }}@isset($nonacademic_membership){{ $nonacademic_membership->registration_end_date }}@endisset" required
                    autocomplete="registration_end_date"readonly autofocus>

                @error('registration_end_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                </div>
            </div>                      
         
        </form>  
    </div>
</div>
@endsection

  