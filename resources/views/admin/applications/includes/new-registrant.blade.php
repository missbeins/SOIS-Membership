<div class="modal fade" id="addNewRegistrant" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('membership.admin.academicapplication-addnewregistrant') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">New Registrant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                       <div class="mb-1">
                        <small style="color: red">Note: All added registrants will only be allowed to register for accounts.</small>

                       </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Email address <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" required>
                        </div>
                        <div class="mb-2">
                            <label for="first_name" class="form-label">Firstname <span class="text-danger">*</span></label>
                            <input class="form-control" id="first_name" name="first_name" required>
                        </div>
                        <div class="mb-2">
                            <label for="middle_name" class="form-label">Middlename</label>
                            <input class="form-control" id="middle_name" name="middle_name">
                        </div>
                        <div class="mb-2">
                            <label for="last_name" class="form-label">Lastname <span class="text-danger">*</span></label>
                            <input class="form-control" id="last_name" name="last_name" required>
                        </div>
                        <div class="mb-2">
                            <label for="suffix" class="form-label">Suffix</label>
                            <input class="form-control" id="suffix" name="suffix">
                        </div>
                        <div class="mb-2">
                            <label for="student_number" class="form-label">Student Number</label>
                            <input class="form-control" id="student_number" name="student_number">
                        </div>
                        <div>
                            <label for="organization_id" class="form-label">Organization <span class="text-danger">*</span></label>
                            <select name="organization_id" class="form-control" required>
                                <option disabled selected>Select organization..</option>
                                @foreach(\App\Models\Organizations::all() as $organization)
                                    <option value="{{ $organization->organization_id }}">
                                        {{ $organization->organization_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    
                </div>
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="sumbit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>
