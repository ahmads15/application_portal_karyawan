@extends('layouts.app-spinner')
@section('content')

<section class="content">
    @include('layouts.partials.alerts')
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
                            <h3 class="text-themecolor"> Edit User</h3>
                        </div>
                        <div class="col-md-12 col-8 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item">Employee Master By Admin</li>
                                <li class="breadcrumb-item active">Edit User</li>
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
                        <h4 class="card-title">Edit User</h4>
                        <hr>
                        {{ Form::model($users, array('route' => array('users.update', $users->id), 'method' => 'PUT')) }}
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
                            <label for="pwd1">Company Name</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="far fa-building"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control"  name="company_name" value="{{$users->company_name}}"
                                    >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pwd2">Company Email<b style="color:red">*</b></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="far fa-envelope"></i>
                                    </span>
                                </div>
                                <input type="email" name="email" class="form-control" value="{{$users->email}}">
                            </div>
                        </div>
                        <div class='form-group'>
                                {{ Form::label('Roles') }}
                                <br> @foreach ($roles as $role) {{ Form::checkbox('roles[]', $role->id ) }} {{ Form::label($role->name, ucfirst($role->name))
                                }}
                                <br> @endforeach
                        </div>
                        <div class="form-group">
                                <label for="pwd2">New Password<b style="color:red">*</b></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>
                                    <input type="password" name="password" class="form-control" >
                                </div>
                        </div>
                        <div class="form-group">
                                <label for="pwd2">Confirm Password<b style="color:red">*</b></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>
                                    <input type="password" name="password_confirmation" class="form-control" >
                                </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> Save</button>
                            <a href="{{url('users')}}">
                                <button type="button" class="btn btn-inverse">Cancel</button>
                            </a>
                        </div>
                            
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
    </body>
</section>


@endsection