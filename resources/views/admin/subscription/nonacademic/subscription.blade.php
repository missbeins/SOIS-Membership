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
                   Payments Details / Membership Payments
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
                  @csrf
                    <label class="input-group-text" for="inputGroupSelect01">{{ __('Filter') }}</label>
                    <select class="form-control @error('query') is-invalid @enderror" id="inputGroupSelect01" name="query">
                        <option disabled selected>Choose a membership...</option>
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
                <table class="table table-light table-sm table-striped table-hover table-responsive" id="nonapayments">
                    <thead>
                        <tr>
                            <th class="col-sm-2">Control Number</th>
                            <th class="col-sm-2">Membership</th>
                            <th scope="col-sm-3">Name</th>
                            <th scope="col-sm-2">Year and Section</th>
                            <th scope="col-sm-2">Contact</th>
                            <th class="col-sm-2">Amount Paid</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @if ($paidmembers->isNotEmpty())
                            @foreach ($paidmembers as $member)
                                <tr>
                                    <td>{{ $member->control_number }}</td>
                                    <td>{{ $member->semester }}({{date_format(date_create($member->membership_start_date), 'M. d, Y' )   }} - {{date_format(date_create($member->membership_end_date), 'M. d, Y' )   }})</td>
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
                {{ $paidmembers->links() }}
           @endif
        </div>
    </div>
</div>
@endsection
@push('scripts')
    {{-- Import Datatables --}}
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
@endpush

@section('scripts')
    <script type="module">
        // Simple-DataTables
        // https://github.com/fiduswriter/Simple-DataTables
        window.addEventListener('DOMContentLoaded', event => {
            const dataTable = new simpleDatatables.DataTable("#nonapayments", {
                perPage: 10,
                searchable: true,
                labels: {
                    placeholder: "Search on current page...",
                    noRows: "No data to display in this page or try in the next page.",
                },
            });
        });
    </script>
@endsection