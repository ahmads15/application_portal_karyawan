@extends('layouts.app-spinner')
@section('content')

<section class="content">
    <style>
        .image {
            opacity: 1;
            display: block;
            width: 30%;
            transition: .5s ease;
            backface-visibility: hidden;
        }
        .middle {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 15%;
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
                            <h3 class="text-themecolor"> Update Profile</h3>
                        </div>
                        <div class="col-md-12 col-8 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item">Settings</li>
                                <li class="breadcrumb-item active">Update Profile</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                        <div class="card-body">
                                @include('layouts.partials.alerts')
                                <h4 class="card-title">Update Profile</h4>
                                <hr>
                                <center class="">
                                    @if(Auth::user()->profile_picture == null)
                                    <img style="" src="{{asset('images/user.png')}}" class="img-circle image" />
                                    @else
                                    <img style="" src="{{asset('images/profile/'.Auth::user()->profile_picture)}}"
                                        class="img-circle image">
                                    @endif
                                    <form action="{{url('user-update-picture')}}" method="POST" enctype="multipart/form-data"
                                        style="display: none">
                                        {{csrf_field()}}
                                        <input type="hidden" name="id" value="{{Auth::user()->id}}">
                                        <input type="file" name="profile_picture" id="upload-profile" accept="image/*">
                                        <button type="submit" id="submit-profile-picture"></button>
                                    </form>
                                    <div class="middle">
                                        <button id="trigger" class="btn btn-primary text"><i class="fa fa-edit"></i></button>
                                        @if(Auth::user()->profile_picture != null)
                                        <a href="{{url('user-remove-picture/'.Auth::user()->id)}}" id="remove-profile-picture"
                                            class="btn btn-danger text"><i class="fa fa-trash"></i></a>
                                        @endif
                                    </div>
                                </center>
                        </div>
                    <div class="card-body">
                        <form action="" class="form-horizontal" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                        @if ($errors->any())
                        <div class="form-group">
                            <div class="alert alert-danger col-md-12">
                                {{ $errors->first() }}
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name<b style="color:red">*</b> </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="ti-user"></i>
                                    </span>
                                </div>
                                <input type="text" name="name" class="form-control" value="{{$users->name}}">
                            </div>
                        </div>
                        <div class="form-group">
                                <label for="exampleInputEmail1">Address<b style="color:red">*</b> </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="mdi mdi-account-location"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="address" class="form-control" value="{{$users->address}}">
                                </div>
                        </div>
                        <div class="form-group">
                                <label for="exampleInputEmail1">Education<b style="color:red">*</b> </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-university" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="education" class="form-control" value="{{$users->education}}">
                                </div>
                        </div>
                        <div class="form-group">
                                <label for="exampleInputEmail1">Marital Status<b style="color:red">*</b> </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                                <i class="fas fa-info"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="status" class="form-control" value="{{$users->status}}">
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="pwd2">Private Email<b style="color:red">*</b></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="far fa-envelope"></i>
                                    </span>
                                </div>
                                <input type="email" name="private_email" class="form-control" value="{{$users->private_email}}">
                            </div>
                        </div>
                        <div class="form-group">
                                <label for="pwd2">Phone Number<b style="color:red">*</b></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-mobile-alt"></i>
                                        </span>
                                    </div>
                                    <input type="number" name="phone_number" class="form-control" value="{{$users->phone_number}}">
                                </div>
                        </div>
                        <div class="form-group">
                                <label for="pwd2">Emergency Name<b style="color:red">*</b></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="ti-user"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="emergency_name" class="form-control" value="{{$users->emergency_name}}">
                                </div>
                        </div>
                        <div class="form-group">
                                <label for="pwd2">Emergency Number<b style="color:red">*</b></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-mobile-alt"></i>
                                        </span>
                                    </div>
                                    <input type="number" name="emergency_number" class="form-control" value="{{$users->emergency_number}}">
                                </div>
                        </div>
                        <hr>
                        <div>
                                <h5><b>Notes :</b></h5>
                                <h6>[<b style="color: red">*</b>]  Mendatory Data </h6>
                        </div>
                        <br>
                        <div class="form-actions">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                <a href="{{url('profile')}}">
                                        <button type="button" class="btn btn-inverse">Cancel</button>
                                </a>
                        </div>
                        </form>
                    </div>
                    
                </div>
            </div>
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
</section>


@endsection