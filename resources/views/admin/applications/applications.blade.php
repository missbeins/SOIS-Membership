@extends('membership.dashboard')

@section('content')

    <div class="container">
        <h4 class="mb-2">Application Requests</h4>
        <table class="table table-success table-striped table-responsive">
            <thead>
                <tr>
                    <th scope="col" width="50">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>


            </tbody>

        </table>
        {{-- <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-left">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav> --}}
    </div>
@endsection
