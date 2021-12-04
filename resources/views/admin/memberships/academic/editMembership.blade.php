@extends('membership.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Membership') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('membership.admin.academicmembership.update', $academic_membership->academic_membership_id) }}">
                            @csrf
                            @method('PATCH')
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
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="registration_status" class="form-label ">{{ __('Registration Status') }}<span style="color:red">*</span></label>
                                    <select aria-label="Default select example" name="registration_status" class="form-control @error('registration_status') is-invalid @enderror"
                                        value="{{ old('registration_status') }}" required>
                                        <option>Open</option>
                                        <option>Close</option>
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
                                        <option>Active</option>
                                        <option>Close</option>
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
                                <label for="start_date" class="form-label">{{ __('Start Date') }}<span style="color:red">*</span></label>
                                <input id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date"
                                    value="{{ old('start_date') }}@isset($academic_membership){{ $academic_membership->start_date }}@endisset" required
                                    autocomplete="start_date" autofocus>
                
                                @error('start_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                                <div class="col-md-6">
                                  <label for="end_date" class="form-label">{{ __('End Date') }}<span style="color:red">*</span></label>
                              <input id="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date"
                                  value="{{ old('end_date') }}@isset($academic_membership){{ $academic_membership->end_date }}@endisset" required
                                  autocomplete="end_date" autofocus>
              
                              @error('end_date')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                                </div>
                            </div>
                      </div>
                                
                        <div class="modal-footer justify-content-end">
                          <button type="submit" class="btn btn-primary ">Submit</button>
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                </form>  
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

  