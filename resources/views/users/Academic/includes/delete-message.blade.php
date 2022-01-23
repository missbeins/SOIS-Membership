<form action="{{ route('membership.user.academic.delete', $message->message_id) }}" method="POST">
    @csrf
    @method('DELETE')

    <div class="modal fade" id="deletemessage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Delete Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <p>Do you really want to delete the message?</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button></div>
                </div>
            </div>
        </div>
    </div>
</form>
