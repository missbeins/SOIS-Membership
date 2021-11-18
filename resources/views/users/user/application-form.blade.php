<div class="modal text-dark" id="applicationform" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
    tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel2">Application Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" method="POST" action="#">
                    @csrf
                    {{-- <input type="hidden" value="{{ Auth::user()->user_id }}" name="user_id"> --}}
                    <div class="col-md-4">
                        <label for="inputEmail4" class="form-label">Firstname</label>
                        <input type="text" class="form-control" id="inputEmail4" name="first_name"
                            value="{{ Auth::user()->first_name }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="inputPassword4" class="form-label">Middlename</label>
                        <input type="text" class="form-control" id="inputPassword4" name="middle_name"
                            value="{{ Auth::user()->middle_name }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="inputPassword4" class="form-label">Lastname</label>
                        <input type="text" class="form-control" id="inputPassword4" name="last_name"
                            value="{{ Auth::user()->last_name }}" required>
                    </div>
                    <div class="col-12">
                        <label for="inputAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St"
                            name="address" required>
                    </div>
                    <div class="col-7">
                        <label for="inputAddress2" class="form-label">Email</label>
                        <input type="email" class="form-control" id="inputAddress2"
                            value="{{ Auth::user()->email }}" name="email" required>
                    </div>
                    <div class="col-5">
                        <label for="inputAddress2" class="form-label">Student Number</label>
                        <input type="text" class="form-control" id="inputAddress2" name="student_number"
                            value="{{ Auth::user()->student_number }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="inputState" class="form-label">Organization</label>
                        <select id="inputState" class="form-select" name="organization" required>
                            @foreach ($available_organizations as $org)
                                <option value="{{ $org->organization_id }}">{{ $org->organization_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="inputState" class="form-label">Gender</label>
                        <select id="inputState" class="form-select" name="gender" required>
                            <option selected>Male</option>
                            <option>Female</option>
                            <option>Others</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="inputPassword4" class="form-label">Contact</label>
                        <input type="text" class="form-control" id="inputPassword4" name="mobile_number"
                            value="{{ Auth::user()->mobile_number }}" required>
                    </div>
                    <div class="col-6">
                        <label for="inputState" class="form-label">Course</label>
                        <select id="inputState" class="form-select" name="course" required>
                            <option value="{{ Auth::user()->course['course_name'] }}">
                                {{ Auth::user()->course['course_name'] }}
                            </option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="inputState" class="form-label">Year and section</label>
                        <select id="inputState" class="form-select" name="year_and_section" required>
                            <option selected>{{ Auth::user()->year_and_section }}</option>

                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="inputPassword4" class="form-label">Date of birth</label>
                        <input type="date" class="form-control" id="inputPassword4" name="date_of_birth" value="{{ Auth::user()->date_of_birth }}"required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
