@extends('membership.dashboard')

@section('content')
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </symbol>
</svg>
<div class="mt-3">
    
    {{-- Title and Breadcrumbs --}}
    <div class="d-flex justify-content-between align-items-center">
       
        {{-- Breadcrumbs --}}
        <nav aria-label="breadcrumb align-items-center">
            <ol class="breadcrumb justify-content-center ">
                
                <li class="breadcrumb-item active" aria-current="page">
                    Applications / Expected Registrants
                </li>

            </ol>
        </nav>
    </div>
    @if (isset($errors) && $errors->any())
        <div class="alert alert-danger alert-dismissible mt-2">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>

            @foreach ($errors->all() as $error )
                {{ $error }}
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        </div>
    @endif
    <div class="card">
        <div class=" card-header text-light" style="background-color: #c62128">
            <h6 class="float-left">Expected Registrants</h6>
            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                        data-bs-target="#ImportRegistrant">
                        Import Registrants
            </button>
            @include('admin.applications.academic.includes.import')
            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                        data-bs-target="#addNewRegistrant">
                        New Registrant
            </button>
            @include('admin.applications.academic.includes.new-registrant')
            @if (session()->has('failures'))

                    <button type="button" class="btn btn-danger btn btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    View Errors
                    </button>
                    <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Importing Errors</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-danger table-responsive table-hover table-striped mt-2">
                                        <thead>
                                            <tr>
                                                <th>Row</th>
                                                <th>Attribute</th>
                                                <th>Errors</th>
                                                <th>Value</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (session()->get('failures') as $failure)
                                            <tr>
                                                <td>{{ $failure->row() }}</td>
                                                <td>{{ $failure->attribute() }}</td>
                                                <td>
                                                    <ul>
                                                        @foreach ($failure->errors() as $e)
                                                            <li>{{ $e }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>{{ $failure->values()[$failure->attribute()] }}</td>
                                            </tr>    
                                            @endforeach
                                            
                                        </tbody>
                                    </table>  
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            
                                </div>
                            </div>
                            </div>
                        </div>                                      
                    @endif
        </div>
        <div class="card-body table-responsive text-center">
                <table class="table table-hover table-striped table-bordered table-light">
                <thead>
                    <tr> 
                        
                        <th class="col-sm-1">@sortablelink('applicant_id','#')</th>
                        <th class="col-sm-4">@sortablelink('first_name','Name')</th>
                        <th class="col-sm-4">@sortablelink('student_number','Student Number')</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @if ($expected_applicants->isNotEmpty())
                        @foreach ($expected_applicants as $expected_applicant)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $expected_applicant->first_name }} {{ $expected_applicant->middle_name }} {{ $expected_applicant->last_name }} {{ $expected_applicant->suffix }}</td>
                                <td>{{ $expected_applicant->student_number }}</td>
                                
                                
                            </tr>
                        @endforeach
                    @else
                        <tr><td class="text-center" colspan="7">No results found!</td></tr>
                    @endif
                </tbody>
            </table>
            {!! $expected_applicants->appends(Request::except('page'))->render() !!}
            <p class="text-center">

                Displaying {{$expected_applicants->count()}} of {{ $expected_applicants->total() }} registrants.
            </>
        </div>
    </div>
</div>
  
@endsection
