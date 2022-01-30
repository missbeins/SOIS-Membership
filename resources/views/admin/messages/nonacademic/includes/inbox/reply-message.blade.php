<form action="{{ route('membership.admin.nonacademic.reply', $message->reply_id) }}" method="post">
    @csrf
    <div class="modal fade" id="replymessage{{ $message->reply_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Reply to a Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Replying to: {{ $message->first_name }} {{ $message->middle_name }} {{ $message->last_name }} {{ $message->suffix }}</p>
                    <input type="hidden" name="user_id" value="{{ $message->user_id }}">
                    <input type="hidden" name="organization_id" value="{{ $message->organization_id }}">
                    <div class="mb-3">
                        <textarea name="reply" id="" cols="60" rows="10"></textarea>  
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send</button>

                </div>
            </div>
        </div>
    </div>
</form>
