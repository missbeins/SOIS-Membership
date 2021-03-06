@extends('membership.dashboard')

@section('content')
<div class="mt-3">
    {{-- Title and Breadcrumbs --}}
    <div class="d-flex justify-content-between align-items-center">
       
        {{-- Breadcrumbs --}}
        <nav aria-label="breadcrumb align-items-center">
            <ol class="breadcrumb justify-content-center ">
                
                <li class="breadcrumb-item active" aria-current="page">
                Members / Official Members
                </li>

            </ol>
        </nav>
    </div>
    @if (isset($errors) && $errors->any())
        <div class="alert alert-danger mt-2">
            @foreach ($errors->all() as $error )
                {{ $error }}
            @endforeach
        </div>
     @endif
    <div class="card">
        <div class=" card-header text-light" style="background-color: #c62128; padding:10px 10px;">
            <div class="row">
                <div class="col-md-8">
                    <h4 class="float-left">Official Members</h4>
                </div>
                <form class="col-md-4 input-group" style="width:30%; height:2px" action="{{ route('membership.adviser.academic.filter-members') }}" method="get">
                   @csrf
                            <label class="input-group-text" style="border-top-left-radius:15%; border-bottom-left-radius:15%;" for="inputGroupSelect01">{{ __('Filter') }}</label>
                            <select class="form-control @error('query') is-invalid @enderror" id="inputGroupSelect01" name="query">
                                <option selected disabled>Choose a membership...</option>
                                @foreach ($academic_memberships as $academic_membership)
                                    <option value="{{ $academic_membership->academic_membership_id }}">{{ $academic_membership->semester }}({{ $academic_membership->school_year }})</option>                          
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
       
            <table class="table table-light table-sm table-striped table-hover" id="members">
                <thead>
                    <tr>
                        
                        <th class="col-sm-3">Membership</th>
                        <th scope="col-sm-3">Name</th>
                        <th scope="col-sm-2">Year and Section</th>
                        <th scope="col-sm-2">Contact</th>
                        <th class="col-sm-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($paidmembers->isNotEmpty())
                        @foreach ($paidmembers as $member)
                            <tr>
                            
                                <td>{{ $member->semester }}({{date_format(date_create($member->membership_start_date), 'M. d, Y' )   }} - {{date_format(date_create($member->membership_end_date), 'M. d, Y' )   }})</td>
                                <td>{{ $member->first_name }} {{ $member->middle_name }} {{ $member->last_name }}</td>
                                <td>{{ $member->year_and_section }}</td>
                                <td>{{ $member->contact }}</td>
                                <td>
                                 
                                    <a href="{{ route('membership.adviser.academic.show-member-detail',[ $member->academic_member_id,  $member->organization_id]) }}" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="view details"><i class="fas fa-eye" ></i> View</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr><td class="text-center" colspan="7">No results found!</td></tr>
                    @endif
                </tbody>
            </table>
            {{-- {{ $paidmembers->links() }} --}}
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
            const dataTable = new simpleDatatables.DataTable("#members", {
                perPage: 5,
                searchable: true,
                labels: {
                    placeholder: "Search on current page...",
                    noRows: "No data to display in this page or try in the next page.",
                },
            });
        });
    </script>
@endsection
