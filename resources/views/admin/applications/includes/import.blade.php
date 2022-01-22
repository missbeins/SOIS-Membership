<div class="modal fade" id="ImportRegistrant" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Registrants Upload</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <form action="{{ route('membership.admin.expectedstudent-import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="formFile" class="form-label">Upload all the expected students for Account registration. Upload file ('.xlsx')</label>
                        <p style="color: red">Note: All added registrants will only be allowed to register for accounts.</p>
                        <input class="form-control" type="file" id="formFile" name="file" required>
                        <div class="mt-3"> 
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Upload</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
