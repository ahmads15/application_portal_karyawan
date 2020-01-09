<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from wrappixel.com/demos/admin-templates/material-pro/material/pages-blank.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 21 May 2019 18:37:28 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset("images/favicon.png")}}">
    <title>Emportal</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{asset("plugins/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet">
    {{-- data tables --}}
    <link rel="stylesheet" type="text/css" href="{{asset("plugins/datatables.net-bs4/css/dataTables.bootstrap4.css")}}">
    <!-- Editable CSS -->
    <link type="text/css" rel="stylesheet" href="{{asset("plugins/jsgrid/jsgrid.min.css")}}" />
    <link type="text/css" rel="stylesheet" href="{{asset("plugins/jsgrid/jsgrid-theme.min.css")}}" />
    {{-- charts --}}
    <link href="{{asset("plugins/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet">
    <!-- chartist CSS -->
    {{-- <link href="{{asset("plugins/chartist-js/dist/chartist.min.css")}}" rel="stylesheet">
    <link href="{{asset("plugins/chartist-js/dist/chartist-init.css")}}" rel="stylesheet">
    <link href="{{asset("plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css")}}" rel="stylesheet">
    --}}
    <!-- summernotes CSS -->
    <link href="{{asset("plugins/summernote/dist/summernote-bs4.css")}}" rel="stylesheet" />
    {{-- datepicker --}}
    <link href="{{asset("plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css")}}"
        rel="stylesheet">
    <!-- Page plugins css -->
    <link href="{{asset("plugins/clockpicker/dist/jquery-clockpicker.min.css")}}" rel="stylesheet">
    <!-- Color picker plugins css -->
    <link href="{{asset("plugins/jquery-asColorPicker-master/dist/css/asColorPicker.css")}}" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="{{asset("plugins/bootstrap-datepicker/bootstrap-datepicker.min.css")}}" rel="stylesheet"
        type="text/css" />
    <!-- Daterange picker plugins css -->
    <link href="{{asset("plugins/timepicker/bootstrap-timepicker.min.css")}}" rel="stylesheet">
    <link href="{{asset("plugins/daterangepicker/daterangepicker.css")}}" rel="stylesheet">
    {{-- file upload --}}
    <link rel="stylesheet" href="{{asset("plugins/dropify/dist/css/dropify.min.css")}}">
    <!-- Custom CSS -->
    <link href="{{asset("css/style.css")}}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{asset("css/colors/blue.css")}}" id="theme" rel="stylesheet">
    <!-- INI DARI ADMIN LTE FREE -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    {{-- <link rel="stylesheet" type="text/css" href="/pathto/css/sweetalert.css"> --}}
    <link rel="stylesheet" href="{{ asset ('dist/css/sweetalert2.css')}}">
    <link rel="stylesheet" href="{{ asset ('dist/css/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset("pathto/css/sweetalert.css")}}">
    <script src="{{asset("plugins/jquery/jquery.min.js")}}"></script>
    <script src="../cdn.rawgit.com/google/code-prettify/master/loader/run_prettify2102.js?lang=css&amp;skin=default">
    </script>
    <!-- Plugin JavaScript -->
    <script src="{{asset("plugins/moment/moment.js")}}"></script>
    <script src="{{asset("plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js")}}">
    </script>
    <!-- Clock Plugin JavaScript -->
    <script src="{{asset("plugins/clockpicker/dist/jquery-clockpicker.min.js")}}"></script>
    <!-- Color Picker Plugin JavaScript -->
    <script src="{{asset("plugins/jquery-asColor/dist/jquery-asColor.js")}}"></script>
    <script src="{{asset("plugins/jquery-asGradient/dist/jquery-asGradient.js")}}"></script>
    <script src="{{asset("plugins/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js")}}"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="{{asset("plugins/bootstrap-datepicker/bootstrap-datepicker.min.js")}}"></script>
    <!-- Date range Plugin JavaScript -->
    <script src="{{asset("plugins/timepicker/bootstrap-timepicker.min.js")}}"></script>
    <script src="{{asset("plugins/daterangepicker/daterangepicker.js")}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="{{ asset ('dist/js/sweetalert2.all.js') }}"></script>
    <script src="{{ asset ('dist/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset ('dist/js/sweetalert2.js') }}"></script>
    <script src="{{ asset ('dist/js/sweetalert2.min.js') }}"></script>
    <script src="{{asset("plugins/popper/popper.min.js")}}"></script>
    <script src="{{asset("plugins/bootstrap/js/bootstrap.min.js")}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{asset("pathto/js/sweetalert.js")}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset("js/jquery.slimscroll.js")}}"></script>
    <!--Wave Effects -->
    <script src="{{asset("js/waves.js")}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset("js/sidebarmenu.js")}}"></script>
    <!--stickey kit -->
    <script src="{{asset("plugins/sticky-kit-master/dist/sticky-kit.min.js")}}"></script>
    <script src="{{asset("plugins/sparkline/jquery.sparkline.min.js")}}"></script>
    {{-- ini js untuk charts --}}
    <!--Custom JavaScript -->
    <script src="{{asset("js/custom.min.js")}}"></script>
    <!-- Footable -->
    <script src="{{asset("plugins/moment/moment.js")}}"></script>
    <script src="{{asset("plugins/footable/js/footable.min.js")}}"></script>
    <script src="{{asset("plugins/bootstrap-select/bootstrap-select.min.js")}}" type="text/javascript"></script>
    <!-- This is data table -->
    <script src="{{asset("plugins/datatables.net/js/jquery.dataTables.min.js")}}"></script>
    <!-- start - This is for export functionality only -->
    <script src="{{asset("cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js")}}"></script>
    <script src="{{asset("cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js")}}"></script>
    <script src="{{asset("cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js")}}"></script>
    <script src="{{asset("cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js")}}"></script>
    <script src="{{asset("cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js")}}"></script>
    <script src="{{asset("cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js")}}"></script>
    <script src="{{asset("cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js")}}"></script>
    <script src="{{asset("plugins/styleswitcher/jQuery.style.switcher.js")}}"></script>
</head>
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="0" /> </svg>
</div>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    {{-- <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="0" /> </svg>
    </div> --}}
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->

        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href=" {{url('dashboard')}}">
                        <!-- Logo text -->
                        <h4 class="box-title" style="text-align: center;font-size: 27px;color: azure"><b>EMP<i
                                    class="fas fa-user-circle"></i>RTAL</b></h4>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse" style="z-index: 1">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        {{-- <li class="nav-item">
                            <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark"
                                href="javascript:void(0)"><i class="ti-menu"></i>
                            </a> 
                        </li> --}}
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if(Auth::user()->profile_picture == null)
                                <img src="{{asset("images/user.png")}}" alt="user" class="profile-pic">
                                @else
                                <img src="{{asset('images/profile/'.Auth::user()->profile_picture)}}" alt="user"
                                    class="profile-pic">
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img">
                                                @if(Auth::user()->profile_picture == null)
                                                {{-- <img src="../images/users/1.jpg" alt="user"> --}}
                                                <img src="{{asset("images/user.png")}}" alt="user">
                                                @else
                                                <img src="{{asset('images/profile/'.Auth::user()->profile_picture)}}"
                                                    alt="user">
                                                @endif
                                            </div>
                                            {{--  --}}
                                            <div class="u-text">
                                                <h4>{{ auth()->user()->name}}</h4>
                                                <small>Member Since :</small><br>
                                                <small class="label label-success">
                                                    {{auth()->user()->created_at->format('F d, Y')}}</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{url('profile')}}"><i class="ti-user"></i> My Profile</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                            <i class="fa fa-power-off"></i> Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- Language -->
                        <!-- ============================================================== -->
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                                    class="flag-icon flag-icon-us"></i></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up"> <a class="dropdown-item"
                                    href="#"><i class="flag-icon flag-icon-in"></i> India</a> <a class="dropdown-item"
                                    href="#"><i class="flag-icon flag-icon-fr"></i> French</a> <a class="dropdown-item"
                                    href="#"><i class="flag-icon flag-icon-cn"></i> China</a> <a class="dropdown-item"
                                    href="#"><i class="flag-icon flag-icon-de"></i> Dutch</a> </div>
                        </li> --}}
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <div class="user-profile"
                    style="background-image: url({{ URL::asset('images/background/user-info.jpg')}})">
                    <!-- User profile image -->
                    {{-- <div class="profile-img"> 
                        <img src="../images/users/profile.png" alt="user" />
                    </div> --}}
                    <div class="profile-img">
                        @if(Auth::user()->profile_picture == null)
                        <img src="{{asset("images/user.png")}}" class="img-circle" alt="user">
                        @else
                        <img src="{{asset('images/profile/'.Auth::user()->profile_picture)}}" class="img-circle"
                            alt="user">
                        @endif
                    </div>
                    <div class="profile-text" style="position: relative;bottom: 23px; text-align: center">
                        <a href="#" role="button" aria-haspopup="true"
                            aria-expanded="true">{{ auth()->user()->name}}</a>
                    </div>
                    <!-- User profile text-->
                    {{-- <div class="profile-text"> <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown"
                            role="button" aria-haspopup="true" aria-expanded="true">{{ auth()->user()->name}}</a>
                    <div class="dropdown-menu animated flipInY"> <a href="#" class="dropdown-item"><i
                                class="ti-user"></i> My Profile</a> <a href="#" class="dropdown-item"><i
                                class="ti-wallet"></i> My Balance</a> <a href="#" class="dropdown-item"><i
                                class="ti-email"></i> Inbox</a>
                        <div class="dropdown-divider"></div> <a href="#" class="dropdown-item"><i
                                class="ti-settings"></i> Account Setting</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div> --}}
            </div>
            <!-- End User profile text-->
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav" style="position: relative;bottom: 23px;">
                <ul id="sidebarnav">
                    @can('Main Menu')
                    <li class="nav-small-cap"><b>MAIN MENU</b></li>
                    <li>
                        <a href="{{url('dashboard')}}"><i class="mdi mdi-gauge"></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="{{url('attendance')}}"><i class="mdi mdi-clock-alert"></i>Attendance</a>
                    </li>
                    <li>
                        <a href="{{url('employee-performance')}}"><i class="mdi mdi-chart-line"></i>Employee
                            Performance</a>
                    </li>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                                class="mdi mdi-file-send"></i><span class="hide-menu">Submission
                                Form</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li>
                                <a href="{{url('SubmissionForm-DayOffSubmission')}}">Leave Submissions</a>
                            </li>
                            <li>
                                <a href="{{url('SubmissionForm-OvertimeSubmission')}}">Overtime Submission</a>
                            </li>
                        </ul>
                    </li>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                                class="mdi mdi-file-multiple"></i><span class="hide-menu">Reporting</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li>
                                <a href="{{url('Reporting-LeaveReport')}}">Leave Report</a>
                            </li>
                            <li>
                                <a href="{{url('Reporting-OvertimeReport')}}">Overtime Report</a>
                            </li>
                            <li>
                                <a href="{{url('Reporting-PaySlipReport')}}">Pay Slip Report</a>
                            </li>
                        </ul>
                    </li>
                    @endcan
                    @can('Employee Data')
                    <li>
                        <a href="{{url('data-employee')}}"><i class="mdi mdi-account-check"></i>Employee
                            Data
                        </a>
                    </li>
                    @endcan
                    @can('Employee Payroll')
                    <li>
                        <a href="{{ url('/EmployeePayroll') }}"> <i class="mdi mdi-credit-card"></i> Employee
                            Payroll</a>
                    </li>
                    @endcan
                    @can('Employee Report')
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                                class="mdi mdi-note-multiple"></i><span class="hide-menu">Employee Report</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li>
                                <a href="{{ url('EmployeeReport-AttendanceReport') }}">Attendance Report</a>
                            </li>
                            <li>
                                <a href="{{ url('EmployeeReport-SalaryReport') }}">Salary Report</a>
                            </li>
                            <li>
                                <a href="{{ url('EmployeeReport-LeaveReport') }}">Leave Report</a>
                            </li>
                            <li>
                                <a href="{{ url('EmployeeReport-OvertimeReport') }}">Overtime Report</a>
                            </li>
                        </ul>
                    </li>
                    @endcan
                    @can('Approval')
                    <li>
                        <a href="{{url('approval')}}"> <i class="mdi mdi-checkbox-multiple-marked-outline"></i>
                            Approval</a>
                    </li>
                    @endcan
                    @hasanyrole('HRD|IT Administrator')
                    <li class="nav-small-cap"><b>MASTER DATA</b></li>
                    @endhasrole
                    @can('Employee Master by Admin')
                    <li>
                        <a href="{{route('users.index')}}"><span> <i class="mdi mdi-account-settings"></i>Employee
                                Master <b style="font-size: 9px">by
                                    Admin</></span></a>
                    </li>
                    @endcan
                    @can('News Master')
                    <li>
                        <a href="{{route ('dashboard.create')}}"><span> <i class="mdi mdi-newspaper"></i> News
                                Master</span></a>
                    </li>
                    @endcan
                    @can('Employee Master by HRD')
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                                class="mdi mdi-table"></i><span class="hide-menu"> Employee Master <b
                                    style="font-size: 9px">by HRD</b></a>
                        <ul aria-expanded="false" class="collapse">
                            <li>
                                <a href="{{url('division-master')}}">Division Master</a>
                            </li>
                            <li>
                                <a href="{{url('master-department')}}">Department Master</a>
                            </li>
                            {{-- @can('manage-position') --}}
                            <li>
                                <a href="{{url('master-position')}}">Position Master</a>
                            </li>
                            {{-- @endcan --}}
                            <li>
                                <a href="{{url('master-employee-detail')}}">Employee Detail</a>
                            </li>
                        </ul>
                    </li>
                    @endcan
                    @can('Payroll Master')
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                                class="mdi mdi-file-chart"></i><span class="hide-menu">Payroll Master</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li>
                                <a href="{{url('masterdata-payrollmaster-salarylevelmaster')}}">Salary Level
                                    Master</a>
                            </li>
                            <li>
                                <a href="{{url('masterdata-payrollmaster-leavetypemaster')}}"> Leave Type
                                    Master</a>
                            </li>
                            <li>
                                <a href="{{ url('masterdata-payrollmaster-workingdaysmaster') }}"><i
                                        class="fa fa-circle-o"></i>Working Days Master</a>
                            </li>
                            <li>
                                <a href="{{ url('masterdata-payrollmaster-bankmaster') }}"><i
                                        class="fa fa-circle-o"></i>Bank Master</a>
                            </li>
                        </ul>
                    </li>
                    @endcan
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
    </div>
    </aside>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- .right-sidebar -->
            <div class="right-sidebar" style="font-size: medium">
                <div class="slimscrollright">
                    <div class="rpanel-title"> Settings <span><i class="ti-close right-side-toggle"></i></span>
                    </div>
                    <div class="r-panel-body">
                        <ul class="m-t-20 chatonline">
                            <li>
                                <a href="{{url('update-profile/'.Auth::user()->id)}}">
                                    Profile
                                </a>
                            </li>
                            <li>
                                <a href="{{url('update-account/'.Auth::user()->id)}}">
                                    Account</a>
                            </li>
                            @can('Administer roles & permissions')
                            <li>
                                <a href="{{route ('roles.index')}}">
                                    Roles & Permissions
                                </a>
                            </li>
                            @endcan
                            {{-- <li>
                                    <a href="{{route ('permissions.index')}}">
                                        Permissions
                                    </a>
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </div>
            <div class="">
                <button
                    class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-sm pull-right m-l-10"><i
                        class="ti-settings text-white"></i></button>
            </div>
            <!-- ============================================================== -->
            <!-- End Right sidebar -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <div class="content-wrapper" style="margin-left: 25px;margin-right: 25px;font-size: small">
            <!-- Content Header (Page header) -->
            @yield('content')
            <!-- /.content -->
        </div>
        <footer class="footer" style="font-size: medium">
            © 2019 Emportal Solutions
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->

    </head>
    <script src="{{ asset ('dist/js/time.js')}}"></script>

    <!-- Editable -->
    <script src="{{asset("plugins/jsgrid/db.js")}}"></script>
    <script type="text/javascript" src="{{asset("plugins/jsgrid/jsgrid.min.js")}}"></script>
    <script src="{{asset("js/jsgrid-init.js")}}"></script>
    <script src="{{asset("plugins/summernote/dist/summernote-bs4.min.js")}}"></script>
    <!-- jQuery file upload -->
    <script src="{{asset("plugins/dropify/dist/js/dropify.min.js")}}"></script>
    <!-- Session-timeout -->

    {{-- <script src="{{asset("plugins/session-timeout/jquery.sessionTimeout.min.js")}}"></script>
    <script src="{{asset("plugins/session-timeout/session-timeout-init.js")}}"></script> --}}




</body>


<!-- Mirrored from wrappixel.com/demos/admin-templates/material-pro/material/pages-blank.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 21 May 2019 18:37:28 GMT -->

</html>