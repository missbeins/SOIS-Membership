@extends('membership.dashboard')

@section('content')
<div class="mt-3">
    <div class="mt-3">
        {{-- Title and Breadcrumbs --}}
        <div class="d-flex justify-content-between align-items-center">
          
           {{-- Breadcrumbs --}}
           <nav aria-label="breadcrumb align-items-center">
               <ol class="breadcrumb justify-content-center ">
                   
                   <li class="breadcrumb-item active" aria-current="page">
                   Payments Details / Membership Payments / Filter Payments
                   </li>
                   <li class="breadcrumb-item">
                       <a href="{{route('membership.admin.nonacademic.nonacademicpayment.index')}}" class="text-decoration-none">Back</a>
                   </li>
   
               </ol>
           </nav>
       </div>
    <div class="card">
        <div class=" card-header text-light" style="background-color: #c62128">
            <div class="row">
                <div class="col-md-8">
                    <h5 class="float-left">Membership Payments</h5>
                </div>
                <form class="col-md-4 input-group" style="width:30%" action="{{ route('membership.admin.nonacademic.nonacademicfilterPayment') }}" method="get">
                  
                    <label class="input-group-text" for="inputGroupSelect01">{{ __('Filter') }}</label>
                    <select class="form-control @error('query') is-invalid @enderror" id="inputGroupSelect01" name="query">
                        @foreach ($nonacademic_memberships as $nonacademic_membership)
                            <option value="{{ $nonacademic_membership->non_academic_membership_id }}">{{ $nonacademic_membership->semester }}({{ $nonacademic_membership->school_year }})</option>                          
                        @endforeach
                    </select>                        
                            @error('query')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    <button class="input-group-text btn-secondary"type="submit">Enter</button>
           
                </form>
            </div>
        </div>
        <div class="card-body table-responsive text-center">        
            @if (isset($paidmembers))
                <table class="table table-light table-sm table-striped table-hover table-responsive">
                    <thead>
                        <tr>
                            <th class="col-sm-2">@sortablelink('control_number','Control Number')</th>
                            <th scope="col-sm-3">@sortablelink('last_name','Name')</th>
                            <th scope="col-sm-2">@sortablelink('year_and_section','Year and Section')</th>
                            <th scope="col-sm-2">@sortablelink('contact','Contact')</th>
                            <th class="col-sm-2">@sortablelink('membership_fee','Amount Paid')</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @if ($paidmembers->isNotEmpty())
                            @foreach ($paidmembers as $member)
                                <tr>
                                    <td>{{ $member->control_number }}</td>
                                    <td>{{ $member->last_name }} {{ $member->suffix }}, {{ $member->first_name }}
                                        {{ $member->middle_name }}</td>
                                    <td>{{ $member->year_and_section }}</td>
                                    <td>{{ $member->contact }}</td>
                                    <td>₱ {{ $member->membership_fee }}.00</td>
                                  
                                </tr>
                            @endforeach
                        @else
                         <tr><td colspan="6">No results found!</td></tr>
                        @endif
                    </tbody>
                </table>
                {{-- {{ $paidmembers->links() }} --}}
            @endif
        </div>
    </div>
</div>
@endsection
