@extends('membership.dashboard')

@section('content')

    <div class="container">
        <h4 class="mb-2">Membership Renewal</h4>
        <table class="table table-success table-striped table-responsive">
            <thead>
                <tr>
                    <th scope="col" width="50">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Renewal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mondejar, Jerry Jones F.</td>
                    <td>jones@email.com</td>
                    <td>09234568912</td>
                    <td>
                        <a type="button" class="btn btn-success btn-sm text-light" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            <i class="fas fa-edit text-light"> Renew</i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Basical, Cjhay F.</td>
                    <td>cjhay@email.com</td>
                    <td>09264868912</td>
                    <td>
                        <a type="button" class="btn btn-success btn-sm text-light" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            <i class="fas fa-edit text-light"> Renew</i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Worthy, James P.</td>
                    <td>james@email.com</td>
                    <td>09986531912</td>
                    <td>
                        <a type="button" class="btn btn-success btn-sm text-light" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            <i class="fas fa-edit text-light"> Renew</i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>Borja, John F.</td>
                    <td>john@email.com</td>
                    <td>09987456912</td>
                    <td>
                        <a type="button" class="btn btn-success btn-sm text-light" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            <i class="fas fa-edit text-light"> Renew</i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <th scope="row">5</th>
                    <td>Santos, MiguelF.</td>
                    <td>miguel@email.com</td>
                    <td>09239878912</td>
                    <td>
                        <a type="button" class="btn btn-success btn-sm text-light" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            <i class="fas fa-edit text-light"> Renew</i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <th scope="row">6</th>
                    <td>Sanchez, Jones L.</td>
                    <td>sanchez@email.com</td>
                    <td>09234568912</td>
                    <td>
                        <a type="button" class="btn btn-success btn-sm text-light" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            <i class="fas fa-edit text-light"> Renew</i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <th scope="row">7</th>
                    <td>Delfino, Juvanie K.</td>
                    <td>juvan@email.com</td>
                    <td>09654258912</td>
                    <td>
                        <a type="button" class="btn btn-success btn-sm text-light" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            <i class="fas fa-edit text-light"> Renew</i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <th scope="row">8</th>
                    <td>Baleros, Lordan</td>
                    <td>lordan@email.com</td>
                    <td>09234561324</td>
                    <td>
                        <a type="button" class="btn btn-success btn-sm text-light" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            <i class="fas fa-edit text-light"> Renew</i>
                        </a>
                    </td>
                </tr>


            </tbody>
        </table>
        <nav aria-label="Page navigation example">
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
        </nav>
    </div>
@endsection
