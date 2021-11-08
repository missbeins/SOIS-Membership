<form action="{{ route('membership.admin.subscriptions.update', $subscription->academic_member_id) }}" method="POST">
    @csrf
    @method('PATCH')

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop{{ $subscription->academic_member_id }}" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Payment Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Select confirm to proceed.</p>
                    <div class=" form-row">
                        <div class="form-group col-md-10">
                            {{-- <input type="hidden" value="{{ $subscription->academic_membership_id }}" name="requestId"> --}}
                            <input type="hidden" value="{{ $subscription->subscription }}" name="subscription">

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
