
  <!-- Modal -->
  
  <div class="modal fade" id="staticBackdrop{{ $application->application_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Application Request Confirmation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="row g-3 text-start"action="{{ route('membership.admin.applications.update', $application->application_id) }}" method="POST">
                @method('PATCH')
                @csrf
  
                <input id="application_id" type="hidden" class="form-control @error('application_id') is-invalid @enderror" name="application_id" value="{{ $application->application_id }}" required autocomplete="application_id" autofocus>
                <input id="membership_id" type="hidden" class="form-control @error('membership_id') is-invalid @enderror" name="membership_id" value="{{ $application->membership_id }}" required autocomplete="membership_id" autofocus>
                <input id="organization_id" type="hidden" class="form-control @error('organization_id') is-invalid @enderror" name="organization_id" value="{{ $application->organization_id }}" required autocomplete="organization_id" autofocus>
                <input id="user_id" type="hidden" class="form-control @error('user_id') is-invalid @enderror" name="user_id" value="{{ $application->user_id }}" required autocomplete="user_id" autofocus>

                <div class="col-md-4">
                  <label for="first_name" class="form-label">Firstname</label>
                  <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name"
                      value="{{ $application->first_name }}" required readonly>
                      @error('first_name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="middle_name" class="form-label">Middlename</label>
                    <input type="text" class="form-control @error('middle_name') is-invalid @enderror" id="middle_name" name="middle_name"
                        value="{{ $application->middle_name }}" required readonly>
                        @error('middle_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="last_name" class="form-label">Lastname</label>
                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name"
                        value="{{ $application->last_name }}" required readonly>
                        @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Address</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="inputAddress" placeholder="1234 Main St"
                        name="address" value="{{ $application->address }}"required readonly>
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
                <div class="col-7">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        value="{{$application->email }}" name="email" required readonly>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
                <div class="col-5">
                    <label for="student_number" class="form-label">Student Number</label>
                    <input type="text" class="form-control @error('student_number') is-invalid @enderror" id="student_number" name="student_number"
                        value="{{ $application->student_number }}" pattern="[0-9]{4}-[0-9]{5}-[A-Z]{2}-[0]{1}" required readonly>
                        <small>Format: 2019-00000-TG-0</small>
                        @error('student_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
              
                <div class="col-md-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select id="gender" class="form-select" name="gender" required readonly>
                        @foreach ($genders as $gender)
                        <option value="{{ $gender->gender }}" {{ $gender->gender_id == $application->gender_id ? 'selected' : '' }}>
                            {{ $gender->gender }}
                        </option>
                        @endforeach
                    </select>
                    @error('gender')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="mobile_number" class="form-label">Contact</label>
                    <input type="text" class="form-control @error('mobile_number') is-invalid @enderror" id="mobile_number" name="mobile_number"
                        value="{{ $application->contact }}" required readonly>
                    @error('mobile_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="course_id" class="form-label">Course</label>
                    <select id="course_id" class="form-select" name="course_id" required readonly>
                      @foreach ($courses as $course)
                      <option value="{{ $course->course_id }}" {{ $course->course_id == $application->course_id ? 'selected' : '' }}>
                          {{ $course->course_name }}
                      </option>
                      @endforeach
                    </select>
                    @error('course')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="year_and_section" class="form-label">Year and section</label>
                    <select id="year_and_section" class="form-select" name="year_and_section" required readonly>
                        <option selected>{{ $application->year_and_section }}</option>

                    </select>
                    @error('year_and_section')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="date_of_birth" class="form-label">Date of birth</label>
                    <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth" value="{{ $application->date_of_birth}}"required readonly>
                    @error('date_of_birth')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mt-3 float-end" >
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>                          
                </div>   
            </form>
        </div>
      </div>
    </div>
  </div>