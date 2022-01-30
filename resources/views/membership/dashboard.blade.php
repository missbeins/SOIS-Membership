<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Membership') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://kit.fontawesome.com/108007899f.js" crossorigin="anonymous"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">


</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->

        <div id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">

                @can('is-admin')
                    @can ('is-academic')
                    <a class="second-text brand" href="{{ route('membership.admin.academic.academicmembership.index') }}"><i
                        class="fas fa-swatchbook me-2"></i>Membership</a>
                    @elsecan('is-nonacademic')
                    <a class="second-text brand" href="{{ route('membership.admin.nonacademic.nonacademicmembership.index') }}"><i
                        class="fas fa-swatchbook me-2"></i>Membership</a>
                    @endcan
                    
                @elsecan('is-student')
                    <a class="second-text brand" href="{{ route('membership.user.academic.my-organizations') }}"><i
                            class="fas fa-swatchbook me-2"></i>Membership</a>
                @endcan
            </div>
            <div class="list-group list-group-flush my-3" id="myList">
                @can('is-admin')
                    @can('is-academic')
                        <button class="dropdown-btn second-text fw-bold"><i
                            class="fas fa-folder-open me-2"></i>Organization
                            <i class="fa fa-caret-down"></i>
                            </button>
                        <div class="dropdown-container">
                            <a href="{{ route('membership.admin.academic.academicmembership.index') }}"><i class="fas fa-layer-group me-2"></i>Memberships</a>
                            <a href="{{ route('membership.admin.academic.users.index') }}"><i class="fas fa-users-cog me-2"></i>User Management</a>
                            <a href=""><i class="fas fa-cogs me-2"></i>User Logs</a>
                        </div>
                        <a href="{{ route('membership.admin.academic.academicmember.index') }}"
                            class="list-group-item list-group-item-action  second-text fw-bold "><i
                                class="fas fa-users me-2"></i>Members</a>
                        <a href="{{ route('membership.admin.academic.academicpayment.index') }}"
                            class="list-group-item list-group-item-action second-text fw-bold"><i
                                class="fas fa-money-check me-2"></i>Payment Details</a>
                        <button class="dropdown-btn second-text fw-bold"><i
                            class="fas fa-address-book me-2"></i>Applications
                            <i class="fa fa-caret-down"></i>
                            </button>
                        <div class="dropdown-container">
                            <a href="{{ route('membership.admin.academic.academicapplication.index') }}"><i class="fas fa-user-check me-2"></i>Applications Requests</a>
                            <a href="{{ route('membership.admin.academic.academicapplication.registrants') }}"><i class="fas fa-registered me-2"></i>Account Registrants</a>
                            <a href="{{ route('membership.admin.academic.academicapplication.declinedApplications') }}"><i class="fas fa-user-times  me-2"></i>Decline Applications</a>
                        </div>
                        <button class="dropdown-btn second-text fw-bold"><i
                            class="fas fa-comments me-2"></i>Messages
                            <i class="fa fa-caret-down"></i>
                            </button>
                        <div class="dropdown-container">
                            <a href="{{ route('membership.admin.academic.inbox') }}"><i class="fas fa-inbox me-2"></i>Inbox</a>
                            <a href="{{ route('membership.admin.academic.sent') }}"><i class="fas fa-paper-plane me-2"></i>Sent</a></a>
                        </div>
                        {{-- <a href="#" class="list-group-item list-group-item-action second-text fw-bold"><i
                                class="fas fa-paperclip me-2"></i>Reports</a> --}}
                        
                    @elsecan('is-nonacademic')
                        <button class="dropdown-btn second-text fw-bold"><i
                            class="fas fa-folder-open me-2"></i>Organization
                            <i class="fa fa-caret-down"></i>
                            </button>
                        <div class="dropdown-container">
                            <a href="{{ route('membership.admin.nonacademic.nonacademicmembership.index') }}"><i class="fas fa-layer-group me-2"></i>Memberships</a>
                            <a href=""><i class="fas fa-cogs me-2"></i>User Logs</a>
                        </div>
                        <a href="{{ route('membership.admin.nonacademic.nonacademicmember.index') }}"
                            class="list-group-item list-group-item-action  second-text fw-bold "><i
                                class="fas fa-users me-2"></i>Members</a>
                        <a href="{{ route('membership.admin.nonacademic.nonacademicpayment.index') }}"
                            class="list-group-item list-group-item-action second-text fw-bold"><i
                                class="fas fa-money-check me-2"></i>Payment Details</a>
                        <button class="dropdown-btn second-text fw-bold"><i
                            class="fas fa-address-book me-2"></i>Applications
                            <i class="fa fa-caret-down"></i>
                            </button>
                        <div class="dropdown-container">
                            <a href="{{ route('membership.admin.nonacademic.nonacademicapplication.index') }}"><i class="fas fa-user-check me-2"></i>Applications Requests</a>
                            <a href="{{ route('membership.admin.nonacademic.nonacademicapplication.declinedApplications') }}"><i class="fas fa-user-times  me-2"></i>Decline Applications</a>
                        </div>
                        <button class="dropdown-btn second-text fw-bold"><i
                            class="fas fa-comments me-2"></i>Messages
                            <i class="fa fa-caret-down"></i>
                            </button>
                        <div class="dropdown-container">
                            <a href="{{ route('membership.admin.nonacademic.inbox') }}"><i class="fas fa-inbox me-2"></i>Inbox</a>
                            <a href="{{ route('membership.admin.nonacademic.sent') }}"><i class="fas fa-paper-plane me-2"></i>Sent</a></a>
                        </div>
                        {{-- <a href="#" class="list-group-item list-group-item-action second-text fw-bold"><i
                                class="fas fa-paperclip me-2"></i>Reports</a> --}}
                        
                    @endcan
                            

                @elsecan('is-student')
                    <button class="dropdown-btn second-text fw-bold"><i
                        class="fas fa-address-book me-2"></i>Organizations
                        <i class="fa fa-caret-down"></i>
                        </button>
                    <div class="dropdown-container">
                        <a href="{{ route('membership.user.academic.my-organizations') }}"><i class="fas fa-user-friends me-2"></i>Academic</a>
                        <a href=""><i class="fas fa-user-friends me-2"></i>Non-academic</a></a>
                    </div>
        
                    <button class="dropdown-btn second-text fw-bold"><i
                        class="fas fa-address-book me-2"></i>Applications
                        <i class="fa fa-caret-down"></i>
                        </button>
                    <div class="dropdown-container">
                        <a href="{{ route('membership.user.academic.my-applications') }}"><i class="fas fa-user-check me-2"></i>Academic</a>
                        <a href="{{ route('membership.user.nonacademic.my-applications') }}"><i class="fas fa-user-check me-2"></i>Non-cademic</a></a>
                    </div>
                    <button class="dropdown-btn second-text fw-bold"><i
                        class="fas fa-comments me-2"></i>Messages
                        <i class="fa fa-caret-down"></i>
                        </button>
                    <div class="dropdown-container">
                        <a href="{{ route('membership.user.academic.messages') }}"><i class="fas fa-inbox me-2"></i>Inbox</a>
                        <a href="{{ route('membership.user.academic.sent') }}"><i class="fas fa-paper-plane me-2"></i>Sent</a></a>
                    </div>
                   
                    
                @endcan

                <a class=" list-group-item list-group-item-action second-text fw-bold" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"><i class="fas fa-power-off me-2"></i>
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>

        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Dashboard</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent" style="min-width: 10%">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->first_name }} {{ auth()->user()->middle_name }} {{ auth()->user()->last_name }} {{ auth()->user()->suffix }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @can('is-admin')
                                   
                                    <li><a class="dropdown-item" href="{{ route('membership.admin.profile') }}"><i
                                        class="fas fa-user me-2"></i>Profile</a></li>
                                   
                                @endcan
                                @can('is-student')
                                    <li><a class="dropdown-item" href="{{ route('membership.user.profile') }}"><i
                                                class="fas fa-user me-2"></i>Profile</a></li>
                                @endcan
                                <li><a class="dropdown-item" href="{{ url('/profile/password') }}"><i
                                            class="fas fa-user-lock me-2"></i>Change Password</a></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i class="fas fa-power-off me-2"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
               
            </nav>
            {{-- Table --}}
            <div class="container-fluid">
                @include('alerts.alerts')
                @yield('content')
            </div>

        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function() {
            el.classList.toggle("toggled");
        };
    </script>
    <script>
        // Get the container element
        var btnContainer = document.getElementById("myList");

        // Get all buttons with class="btn" inside the container
        var btns = btnContainer.getElementsByClassName("list-group-item");

        // Loop through the buttons and add the active class to the current/clicked button
        for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function() {
                var current = document.getElementsByClassName("active");
                current[0].className = current[0].className.replace(" active", "");
                this.className += " active";
            });
        }
    </script>
     <script>
        //* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
            } else {
            dropdownContent.style.display = "block";
            }
        });
        }
    </script>
</body>

</html>
