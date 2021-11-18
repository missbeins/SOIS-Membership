<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <!-- Modal -->
  <div class="modal fade" id="addmembership" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">New Membership</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
         
                <form method="POST" action="#">
                  @csrf
                  <div class=" mb-2">
                      <label for="semester" class="form-label">{{ __('Semester') }}<span style="color:red">*</span></label>
                      <input id="semester" type="text" class="form-control @error('semester') is-invalid @enderror" name="semester"
                          value="{{ old('semester') }}"required
                          autocomplete="semester" autofocus>
      
                      @error('semester')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
      
                  <div class="mb-2">
                      <label for="school_year" class="form-label">{{ __('School Year') }} <span style="color:red">*</span></label>
                      <input id="school_year" type="text" class="form-control @error('school_year') is-invalid @enderror"
                          name="school_year" value="{{ old('school_year') }}" required
                          autocomplete="school_year" autofocus>
      
                      @error('school_year')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="mb-2">
                      <label for="start_date" class="form-label">{{ __('Start Date') }}<span style="color:red">*</span></label>
                      <input id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date"
                          value="{{ old('start_date') }}" required
                          autocomplete="start_date" autofocus>
      
                      @error('start_date')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="mb-2">
                    <label for="end_date" class="form-label">{{ __('End Date') }}<span style="color:red">*</span></label>
                    <input id="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date"
                        value="{{ old('end_date') }}" required
                        autocomplete="end_date" autofocus>
    
                    @error('end_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                      
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Submit</button>
              </div>
      </form>  
      </div>
    </div>
  </div>
</body>
</html>
  