@extends('layouts.app-spinner')
@section('content')

<section class="content">
    <style>
        .image {
            opacity: 1;
            display: block;
            width: 150px;
            height: 150px;
            transition: .5s ease;
            backface-visibility: hidden;
        }
        .middle {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 25%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }
        .card-body:hover .image {
            opacity: 0.3;
        }
        .card-body:hover .middle {
            opacity: 1;
        }
        .text {
            color: white;
            font-size: 15px;
        }
    </style>

    <body class="fix-header fix-sidebar card-no-border">
        <div id="main-wrapper">
            <div class="content-wrapper">
                <!-- ============================================================== -->
                <!-- Container fluid  -->
                <!-- ============================================================== -->
                <div class="container-fluid">
                    <!-- ============================================================== -->
                    <!-- Bread crumb and right sidebar toggle -->
                    <!-- ============================================================== -->
                    <div class="row page-titles">
                        <div class="col-md-12 col-8 align-self-center">
                            <h3 class="text-themecolor">User Profile</h3>
                        </div>
                        <div class="col-md-12 col-8 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">My Profile</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Column -->
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <center class="m-t-30">
                            <div class="ribbon ribbon-bookmark  ribbon-info">
                                Emp<i class="fa fa-user-circle"></i>rtal
                            </div>
                            @if(Auth::user()->profile_picture == null)
                            <img style="width: 50%" src="{{asset('images/user.png')}}" class="img-circle image" />
                            @else
                            <img style="width: 50%" src="{{asset('images/profile/'.Auth::user()->profile_picture)}}"
                                class="img-circle image">
                            @endif
                            <form action="{{url('user-update-picture')}}" method="POST" enctype="multipart/form-data"
                                style="display: none">
                                {{csrf_field()}}
                                <input type="hidden" name="id" value="{{Auth::user()->id}}">
                                <input type="file" name="profile_picture" id="upload-profile" accept="image/*">
                                <button type="submit" id="submit-profile-picture"></button>
                            </form>
                            <h4 class="card-title m-t-10">{{Auth::user()->name}}</h4>
                        </center>
                    </div>
                    <div>
                    </div>
                    <div class="card-body">
                        <small class="text-muted">Employee ID</small>
                        <h6>{{$user->nip}}</h6>
                        <small class="text-muted">Private Email</small>
                        <h6>{{$user->email}}</h6>
                        <small class="text-muted">Private Phone</small>
                        <h6>{{$user->phone_number}}</h6>
                        <small class="text-muted ">Address</small>
                        <h6>{{$user->address}}</h6>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-8 col-xlg-3 col-md-5 ">
                <div class="card">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="home" role="tabpanel">
                            <div class="card-body">
                                <form class="form-horizontal" role="form">
                                    <div class="form-body">
                                        <h3 class="box-title">Personal Info</h3>
                                        <hr class="m-t-0 m-b-40">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-6">Name :</label>
                                                    <div class="col-md-4">
                                                        <p class="form-control-static"> {{$user->name}} </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-6">Bank :</label>
                                                    <div class="col-md-6">
                                                        <p class="form-control-static">{{$user->bank_code}} - {{$user->bank_name}} </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-6">Number of kids
                                                        :</label>
                                                    <div class="col-md-6">
                                                        <p class="form-control-static"> {{$user->number_of_kids}} </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-6">Bank number
                                                        :</label>
                                                    <div class="col-md-6">
                                                        <p class="form-control-static"> {{$user->no_rekening}} </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-6">Region :</label>
                                                    <div class="col-md-6">
                                                        <p class="form-control-static"> {{$user->region}} </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-6">Marital status
                                                        :</label>
                                                    <div class="col-md-6">
                                                        <p class="form-control-static"> {{$user->status}} </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-6">Gender :</label>
                                                    <div class="col-md-6">
                                                        <p class="form-control-static"> {{$user->gender}} </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-6">Last Education
                                                        :</label>
                                                    <div class="col-md-6">
                                                        <p class="form-control-static"> {{$user->education}} </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <div class="row">
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-6">Date of Birth
                                                        :</label>
                                                    <div class="col-md-6">
                                                        <p class="form-control-static"> <td>{{\Carbon\Carbon::parse($user->birthofdate)->format('d F Y')}}</td> </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-6">Place of Birth
                                                        :</label>
                                                    <div class="col-md-6">
                                                        <p class="form-control-static"> {{$user->placeofbirth}} </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!--/span-->
                                        </div>
                                        <h3 class="box-title">Company Info</h3>
                                        <hr class="m-t-0 m-b-40">
                                        <div class="row">
                                            {{-- <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-6">Supervisor
                                                        :</label>
                                                    <div class="col-md-6">
                                                        <p class="form-control-static"> 
                                                            <b style="color: red">Belom bisa</b>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            {{-- <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-6">Head Supervisor:</label>
                                                    <div class="col-md-6">
                                                        <p class="form-control-static"> 
                                                                <b style="color: red">BELOM BISA</b>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-6">Department
                                                        :</label>
                                                    <div class="col-md-6">
                                                        <p class="form-control-static">   
                                                                {{$user->department_name}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-6"> Division
                                                        :</label>
                                                    <div class="col-md-6">
                                                        <p class="form-control-static">    
                                                            {{$user->division_name}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-6">Position :</label>
                                                    <div class="col-md-6">
                                                        <p class="form-control-static"> 
                                                            {{$user->position_name}} 
                                                        </p>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-6"> Total Salary 
                                                        :</label>
                                                    <div class="col-md-6">
                                                        <p class="form-control-static">   
                                                                Rp.{{number_format ($user->total_salary)}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-6">Employe
                                                        Status:</label>
                                                    <div class="col-md-6">
                                                        <p class="form-control-static"> {{$user->status_karyawan}} </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="control-label text-right col-md-6">Leave
                                                            Amount:</label>
                                                        <div class="col-md-6">
                                                            <p class="form-control-static"> {{$user->default_leave}} Days
                                                            </p>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <h3 class="box-title">Contact Info</h3>
                                        <hr class="m-t-0 m-b-40">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-6">Emergency Name
                                                        :</label>
                                                    <div class="col-md-6">
                                                        <p class="form-control-static"> {{$user->emergency_name}} </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-6"> Emergency
                                                        Number:</label>
                                                    <div class="col-md-6">
                                                        <p class="form-control-static"> {{$user->emergency_number}} </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-6">Company Email
                                                        :</label>
                                                    <div class="col-md-6">
                                                        <p class="form-control-static"> {{$user->email}} </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-6">Private Email
                                                        :</label>
                                                    <div class="col-md-6">
                                                        <p class="form-control-static"> {{$user->private_email}} </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
    </body>
    <script>
        $(document).ready(function () {
                var div = $('.box-profile');          
                $('#trigger').click(function () {
                    var profile = $('#upload-profile');              
                    profile.click();
                    profile.change(function () {
                        $('#submit-profile-picture').click();
                        
                        div.addClass("disabledbox");
                    });
                });
                $('#submit-profile').click(function () {
                    div.addClass("disabledbox");
                });
            });
    </script>
    @endsection