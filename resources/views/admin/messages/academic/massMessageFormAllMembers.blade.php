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
        <form action="{{ route('membership.admin.academic.massMessage-allmembers') }}" method="post">
            @csrf
            <div class="form-group row mb-2">                
                <label for="recipients" class="col-md-3 col-form-label text-md-right">{{ __('Recipient(s)') }}</label>
                <div class="col-md-9">
                    <input type="text" name="recipients" id="recipients" value="All members" readonly>
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="date_of_birth" class="col-md-3 col-form-label text-md-right">{{ __('Message') }}</label>
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