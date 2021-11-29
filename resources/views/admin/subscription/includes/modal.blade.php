<form action="{{ route('membership.admin.payments.update', $member->academic_member_id) }}" method="POST">
    @csrf
    @method('PATCH')

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop{{ $member->academic_member_id }}" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Payment Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                            <input type="hidden" value="{{ $member->membership_status }}" name="subscription">
                            <div class="mb-3 row">
                                <label for="inputReceipt" class="col-sm-3 col-form-label">Receipt No.</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="inputReceipt">
                                </div>
                            </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</form>
