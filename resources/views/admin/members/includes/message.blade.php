
  <!-- Modal -->
  
  <div class="modal fade" id="staticBackdrop{{ $member->academic_member_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Message your member</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="row g-3" action="{{ route('membership.admin.message-member', $member->academic_member_id) }}" method="POST">
            
                @csrf
                <input type="hidden" name="organization_id" value="{{ $member->organization_id }}">
                <input type="hidden" name="user_id" value="{{ $member->user_id }}">
                <div class="col-md-12 text-start">
                    <label for="message_member" class="form-label">Message</label>
                    <textarea class="form-control" name="message_member" id="message_member" cols="30" rows="8" required></textarea>

                        @error('message_member')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                  </div>
                <div class="mt-3 text-start">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>                          
                </div>   
            </form>
        </div>
      </div>
    </div>
  </div>