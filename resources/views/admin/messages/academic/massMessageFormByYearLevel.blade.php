@extends('membership.dashboard')

@section('content')
{{-- Title and Breadcrumbs --}}
<div class="d-flex justify-content-between align-items-center">
       
    {{-- Breadcrumbs --}}
    <nav aria-label="breadcrumb align-items-center">
        <ol class="breadcrumb justify-content-center ">
            
            <li class="breadcrumb-item active" aria-current="page">
                Organization / Messages / Sent / New Message 
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('membership.admin.academic.sent')}}" class="text-decoration-none">Back</a>
            </li>

        </ol>
    </nav>
</div>
<div class="card">
    <div class="card-header text-light" style="background-color: #c62128">{{ __('New Message') }}</div>

    <div class="card-body">
        <form action="{{ route('membership.admin.academic.massMessage-yearlevel') }}" method="POST">
            @csrf
            @foreach ($newYearRange as $item)
                <input type="hidden" name="year_and_section[]" value="{{ $item }}" required>

            @endforeach
            <div class="form-group row mb-2">
                
                    <label for="recipients" class="col-md-3 col-form-label text-md-right">{{ __('Recipient(s)') }}</label>
                    <div class="col-md-9">
                        <select class="form-control" id="recipients" name="recipients[]" multiple id="recipients" required>
                            <option value="All Members">All Members</option>
                            
                            @foreach ($members as $member)
                                <option value="{{ $member->user_id }}">{{ $member->last_name }}{{ $member->suffix }}, {{ $member->first_name }}{{ $member->middle_name }}</option>
                            @endforeach
                        </select>
                        @error('recipients')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                
            </div>
            <div class="form-group row mb-2">
                <label for="date_of_birth"
                    class="col-md-3 col-form-label text-md-right">{{ __('Message') }}</label>

                <div class="col-md-9">
                  
                    <textarea name="message" class="form-control @error('message') is-invalid @enderror" id="message" cols="30" rows="10" required></textarea>
                    @error('message')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary ">Submit</button>
    </div>
</form>
</div>
@endsection

@section('scripts')
    
@push('scripts')
    {{-- Javascript Imports --}}
    
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

   
<script>
$(document).ready(function() {
  // Select2 Multiple
  $('#recipients').select2({
      placeholder: "Select",
      allowClear: true
  });

});

</script>

@endsection