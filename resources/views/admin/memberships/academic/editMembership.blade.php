@extends('membership.dashboard')

@section('content')
{{-- Title and Breadcrumbs --}}
<div class="d-flex justify-content-between align-items-center">
       
    {{-- Breadcrumbs --}}
    <nav aria-label="breadcrumb align-items-center">
        <ol class="breadcrumb justify-content-center ">
            
            <li class="breadcrumb-item active" aria-current="page">
                Organization / Memberships / Edit Membership
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('membership.admin.academic.academicmembership.index')}}" class="text-decoration-none">Back</a>
            </li>

        </ol>
    </nav>
</div>
<div class="card">
    <div class="card-header">{{ __('Edit Membership') }}</div>
    <div class="card-body">
        <form method="POST" action="{{ route('membership.admin.academic.academicmembership.update', [$academic_membership->academic_membership_id, $academic_membership->organization_id]) }}">
            @csrf
            @method('PUT')
            {{-- <input type="hidden" name="organization_id" value="{{ Auth::user()->course['organization_id'] }}"> --}}
            <div class=" mb-2 row"> 
                <div class="col-md-4">
                <label for="semester" class="form-label ">{{ __('Semester') }}<span style="color:red">*</span></label>
                <select aria-label="Default select example" name="semester" class="form-control @error('semester') is-invalid @enderror"
                    value="{{ old('semester') }}" required>
                    <option @isset($academic_membership){{ $academic_membership->semester == '1st Semester' ? 'selected' : '' }} @endisset>1st Semester</option>
                    <option @isset($academic_membership){{ $academic_membership->semester == '2nd Semester' ? 'selected' : '' }} @endisset>2nd Semester</option>
                </select>
                @error('semester')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="col-md-4">
                <label for="membership_fee" class="form-label">{{ __('Membership Fee') }} <span style="color:red">*</span></label>
                <input id="membership_fee" type="number" class="form-control @error('membership_fee') is-invalid @enderror"
                    name="membership_fee" value="{{ old('membership_fee') }}@isset($academic_membership){{ $academic_membership->membership_fee }}@endisset" required
                    autocomplete="membership_fee" autofocus>

                @error('membership_fee')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
            
            
                <div class="col-md-4"> <label for="school_year" class="form-label">{{ __('School Year') }} <span style="color:red">*</span></label>
                <input id="school_year" type="text" class="form-control @error('school_year') is-invalid @enderror"
                    name="school_year" value="{{ old('school_year') }}@isset($academic_membership){{ $academic_membership->school_year }}@endisset" required
                    autocomplete="school_year" autofocus>

                @error('school_year')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-2 row mt-2">
                <div class="col-md-6">
                    <label for="membership_start_date" class="form-label">{{ __('Membership Start Date') }}<span style="color:red">*</span></label>
                    <input id="membership_start_date" type="date" class="form-control @error('membership_start_date') is-invalid @enderror" name="membership_start_date"
                        value="{{ old('membership_start_date') }}@isset($academic_membership){{ $academic_membership->membership_start_date }}@endisset" required
                        autocomplete="membership_start_date" autofocus>
    
                    @error('membership_start_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                    <div class="col-md-6">
                    <label for="membership_end_date" class="form-label">{{ __('Membership End Date') }}<span style="color:red">*</span></label>
                <input id="membership_end_date" type="date" class="form-control @error('membership_end_date') is-invalid @enderror" name="membership_end_date"
                    value="{{ old('membership_end_date') }}@isset($academic_membership){{ $academic_membership->membership_end_date }}@endisset" required
                    autocomplete="membership_end_date" autofocus>

                @error('membership_end_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                    </div>
                </div>
            <div class="row mb-2">
                <div class="col-md-6">
                    <label for="registration_status" class="form-label ">{{ __('Registration Status') }}<span style="color:red">*</span></label>
                    <select aria-label="Default select example" name="registration_status" class="form-control @error('registration_status') is-invalid @enderror"
                        value="{{ old('registration_status') }}" required>
                        <option @isset($academic_membership){{ $academic_membership->registration_status == 'Open' ? 'selected' : '' }} @endisset>Open</option>
                        <option @isset($academic_membership){{ $academic_membership->registration_status == 'Closed' ? 'selected' : '' }} @endisset>Closed</option>
                    
                    </select>
                    @error('registration_status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                    <div class="col-md-6">
                    <label for="status" class="form-label ">{{ __('Status') }}<span style="color:red">*</span></label>
                    <select aria-label="Default select example" name="status" class="form-control @error('status') is-invalid @enderror"
                        value="{{ old('status') }}" required>
                        
                        <option @isset($academic_membership){{ $academic_membership->am_status == 'Active' ? 'selected' : '' }} @endisset>Active</option>
                        <option @isset($academic_membership){{ $academic_membership->am_status == 'Ended' ? 'selected' : '' }} @endisset>Ended</option>
                    
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
                <label for="registration_start_date" class="form-label">{{ __('Registration Start Date') }}<span style="color:red">*</span></label>
                <input id="registration_start_date" type="date" class="form-control @error('registration_start_date') is-invalid @enderror" name="registration_start_date"
                    value="{{ old('registration_start_date') }}@isset($academic_membership){{ $academic_membership->registration_start_date }}@endisset" required
                    autocomplete="registration_start_date" autofocus>

                @error('registration_start_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="col-md-6">
                    <label for="registration_end_date" class="form-label">{{ __('Registration End Date') }}<span style="color:red">*</span></label>
                <input id="registration_end_date" type="date" class="form-control @error('registration_end_date') is-invalid @enderror" name="registration_end_date"
                    value="{{ old('registration_end_date') }}@isset($academic_membership){{ $academic_membership->registration_end_date }}@endisset" required
                    autocomplete="registration_end_date" autofocus>

                @error('registration_end_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                </div>
            </div>                      
            <div class="modal-footer justify-content-end">
                <button type="submit" class="btn btn-primary ">Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
            </div>
        </form>  
    </div>
</div>
@endsection

  