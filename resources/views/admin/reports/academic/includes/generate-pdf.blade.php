<!-- Modal -->
<div class="modal fade" id="exampleModal{{$membership->academic_membership_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Generate PDF by Year Level</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="pdf-form" action="{{  route('membership.admin.academic.generateAcadMembershipPDFperYearLevel')  }}" method="POST">
            @csrf
            <div class="modal-body">
                   
                <input type="hidden" name="membership_id" value="{{ $membership->academic_membership_id }}">
                <select class="form-select" aria-label="Default select example" name="yearLevel">
                    <option selected disabled>Select a year level</option>
                                      
                    @foreach ($newyearLevelscollection as $yearLevel)
                    <option value="{{ $yearLevel->year_and_section }}">{{ $yearLevel->year_and_section }}</option>
                    @endforeach
                  </select>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Continue</button>
            </div>
        </form>
      </div>
    </div>
  </div>