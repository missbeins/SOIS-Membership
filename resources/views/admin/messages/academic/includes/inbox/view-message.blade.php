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
                    @if ($message->message_status == "unread")
                        <form action="{{ route('membership.admin.academic.read-reply',$message->reply_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger">Close</button>
                        </form>
                    @else
                        <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>

                    @endif
                </div>
            </div>
        </div>
    </div>

