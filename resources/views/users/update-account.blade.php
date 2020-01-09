@extends('layouts.app-spinner')
@section('content')

<section class="content">

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
                            <h3 class="text-themecolor"> Update Account</h3>
                        </div>
                        <div class="col-md-12 col-8 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item">Settings</li>
                                <li class="breadcrumb-item active">Update Account</li>
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
                        <h4 class="card-title">Update Account</h4>
                        <hr>
                        @include('layouts.partials.alerts')
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
                            <label for="exampleInputEmail1">New Password<b style="color:red">*</b> </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </div>
                                <input id="password" name="password" type="password" class="form-control" placeholder="password" >
                            </div>
                        </div>
                        <div class="form-group">
                                <label for="exampleInputEmail1">New Password Confirm<b style="color:red">*</b> </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>
                                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="password confirmation">
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
</section>


@endsection