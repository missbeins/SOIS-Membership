<form action="{{ route('membership.user.academic.reply', $message->message_id) }}" method="POST">
    @csrf
    <input type="hidden" name="user_id" value="{{ Auth::user()->user_id }}">
    <input type="hidden" name="organization_id" value="{{ $message->organization_id }}">
    <div class="modal fade" id="replymessage{{ $message->message_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Reply to a Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    <p>Replying to: {{$message->organization_name}}</p>
                   
                    <div class="col-md-6">
                        <p>Message:</p>
                        <textarea name="message" id="" cols="45" rows="10" readonly disabled>{{ $message->message }}</textarea>  
                    </div>
                   
                 
                    <div class="mb-1 col-md-6">
                        <p>Reply:</p>
                        <textarea name="reply" id="" cols="45" rows="10"></textarea>  
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
