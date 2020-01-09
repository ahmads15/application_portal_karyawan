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
                            <h3 class="text-themecolor"> Edit Role</h3>
                        </div>
                        <div class="col-md-12 col-8 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item">Setting</li>
                                <li class="breadcrumb-item">Roles & permissions</li>
                                <li class="breadcrumb-item active">Edit Role</li>
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
                        <h4 class="card-title"><i class="far fa-edit"></i> Edit Role : <b>{{$role->name}}</b></h4>
                        <hr>
                        {{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT')) }}
                        @if ($errors->any())
                        <div class="form-group">
                            <div class="alert alert-danger col-md-12">
                                {{ $errors->first() }}
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            {{ Form::label('name', 'Role Name') }}
                            {{ Form::text('name', null, array('class' => 'form-control')) }}
                        </div>
                        <h6>Assign Permissions</h6>
                        <hr>
                        <div class='form-group'>
                            @foreach ($permissions as $permission)
                            {{Form::checkbox('permissions[]',  $permission->id, $role->permissions ) }}
                            {{Form::label($permission->name, ucfirst($permission->name)) }}<br>
                            @endforeach
                        </div>
                        {{ Form::submit('Save', array('class' => 'btn btn-success')) }}
                        <a href="{{url('roles')}}">
                            <button type="button" class="btn btn-inverse">Cancel</button>
                        </a>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
    </body>
</section>
@endsection