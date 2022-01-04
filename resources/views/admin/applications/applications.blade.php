@extends('membership.dashboard')

@section('content')
<div class="row">
    <div class="col-md-7">
        <div class="mt-3">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="float-left">Membership Application Requests</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive text-center">
                    <table class="table table-hover table-striped table-bordered table-light">
                        <thead>
                            <tr> 
                                <th class="col-sm-1">#</th>
                                <th class="col-sm-4">Name</th>
                                <th class="col-sm-4">Email</th>
                                <th class="col-sm-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            @foreach ($acad_applications as $application)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $application->first_name }} {{ $application->middle_name }} {{ $application->last_name }}</td>
                                    <td>{{ $application->email }}</td>
                                   
                                    <td>
                                            
                                            <!-- Button trigger accept modal -->
                                            <a type="button" href="{{ route('membership.admin.applications.edit',$application->application_id) }}"class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $application->application_id }}">
                                                <i class="fas fa-user-check"></i> Accept
                                            </a>
                                            @include('admin.applications.includes.accept')

                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="event.preventDefault(); document.getElementById('delete-membership-form-{{ $application->application_id }}').submit()">
                                                <i class="fas fa-trash-alt"></i> Decline
                                            </button>
                                            <form class="d-none" id="delete-membership-form-{{ $application->application_id }}"
                                                action="{{ route('membership.admin.applications.destroy', $application->application_id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $acad_applications->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="mt-3">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="float-left">Expected Applicants</h5>
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop">
                                        Import Expected Students
                                    </button>
                            @include('admin.users.includes.import')
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
                    </div>
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
                           
                            @foreach ($expected_applicants as $expected_applicant)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $expected_applicant->first_name }} {{ $expected_applicant->middle_name }} {{ $expected_applicant->last_name }}</td>
                                    <td>{{ $expected_applicant->student_number }}</td>
                                    
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $expected_applicants->links() }}
                </div>
            </div>
        </div>
    </div>

</div>
   
@endsection
