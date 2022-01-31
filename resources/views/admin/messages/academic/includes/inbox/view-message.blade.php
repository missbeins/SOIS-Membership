    <div class="modal fade" id="viewmessage{{ $message->reply_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Read Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Message from: {{ $message->first_name }} {{ $message->middle_name }} {{ $message->last_name }} {{ $message->suffix }}</p>
                    <div class="mb-3">
                        <textarea name="message" id="" cols="60" rows="10" readonly >{{ $message->reply }}</textarea>  
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Close</button>
                </div>
            </div>
        </div>
    </div>

