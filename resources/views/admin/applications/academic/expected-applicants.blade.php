@extends('membership.dashboard')

@section('content')

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
        <div class="alert alert-danger mt-2">
            @foreach ($errors->all() as $error )
                {{ $error }}
            @endforeach
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h5 class="float-left">Expected Registrants</h5>
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
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Student Number</th>
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
            {{ $expected_applicants->links() }}
        </div>
    </div>
</div>
  
@endsection
