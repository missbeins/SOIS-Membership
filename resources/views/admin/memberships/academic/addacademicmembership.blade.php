  <!-- Modal -->
  <div class="modal fade" id="addmembership" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">New Membership</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                <form method="POST" action="{{ route('membership.admin.academic.academicmembership.store') }}">
                  @csrf
                  {{-- <input type="hidden" name="organization_id" value="{{ Auth::user()->course['organization_id'] }}"> --}}
                  <div class=" mb-2 row"> 
                    <div class="col-md-4">
                      <label for="semester" class="form-label ">{{ __('Semester') }}<span style="color:red">*</span></label>
                      <select aria-label="Default select example" name="semester" class="form-control @error('semester') is-invalid @enderror"
                          value="{{ old('semester') }}" required>
                          <option>1st Semester</option>
                          <option>2nd Semester</option>
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
                          name="membership_fee" value="{{ old('membership_fee') }}" required
                          autocomplete="membership_fee" autofocus>
      
                      @error('membership_fee')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  
                    <div class="col-md-4"> <label for="school_year" class="form-label">{{ __('School Year') }} <span style="color:red">*</span></label>
                      <input id="school_year" type="text" class="form-control @error('school_year') is-invalid @enderror"
                          name="school_year" value="{{ old('school_year') }}" required
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
                            value="{{ old('membership_start_date') }}" required
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
                          value="{{ old('membership_end_date') }}" required
                          autocomplete="end_membership_end_dateate" autofocus>
      
                      @error('membership_end_date')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                      <label for="registration_status" class="form-label ">{{ __('Registration Status') }}<span style="color:red">*</span></label>
                      <select aria-label="Default select example" name="registration_status" class="form-control @error('registration_status') is-invalid @enderror"
                          value="{{ old('registration_status') }}" required>
                          <option>Open</option>
                          <option>Closed</option>
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
                          <option>Ended</option>
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
                          value="{{ old('registration_start_date') }}" required
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
                        value="{{ old('registration_end_date') }}" required
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
      </form>  
      </div>
    </div>
  </div>

  