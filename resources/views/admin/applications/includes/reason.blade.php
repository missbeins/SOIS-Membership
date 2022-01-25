<div class="modal fade" id="reason{{ $application->application_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Reason for Declining of Application</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label float-start" >Reason/s</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" readonly value="Reasons here...">
                    </div>                    
                </div>
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="sumbit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>
