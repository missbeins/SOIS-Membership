<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Generate PDF by Year Level</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="pdf-form" action="{{  route('membership.student-services.generateAcadMembershipPDF')  }}" method="POST">
            @csrf
            <div class="modal-body">
                   
                <input type="hidden" name="membership_id" value="{{ $membership->academic_membership_id }}">
                <select class="form-select" aria-label="Default select example">
                    <option selected disabled>Select a year level</option>
                    <option value="1">Year level One</option>
                    <option value="2">Year level Two</option>
                    <option value="3">Year level Three</option>
                    <option value="4">Year level Four</option>
                    <option value="4">Year level Five</option>
                  </select>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </form>
      </div>
    </div>
  </div>