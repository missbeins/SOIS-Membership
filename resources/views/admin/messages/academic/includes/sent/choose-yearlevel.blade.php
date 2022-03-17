<div class="modal fade" id="chooseyearlevel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Please select a Recipient(s).</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <form action="{{ route('membership.admin.academic.show-massMessageForm') }}" method="POST">
                    @csrf
                <label for="recipients" class="col-md-12 col-form-label text-md-right">{{ __('Message by Year Level') }}</label>
                    <div class="col-md-12">
                        <select class="form-control" id="year_and_section" name="year_and_section[]" multiple id="year_and_section">
                            
                            @foreach ($newyearLevelscollection as $level)
                                <option value="{{ $level->year_and_section }}">{{ $level->year_and_section }}</option>
                            @endforeach
                        </select>
                        @error('year_and_section')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-2">
                        <input type="checkbox" name="allmembers" value="on">
                        <label>Message all official members</label>

                        @error('allmembers')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Continue</button>
            </div>
            </form>
        </div>
    </div>
    

</div>
