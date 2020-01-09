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
                            <h3 class="text-themecolor"> Company Setting</h3>
                        </div>
                        <div class="col-md-12 col-8 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item">Setting</li>
                                <li class="breadcrumb-item active">Company</li>
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
                        <h4 class="card-title"><i class=" ti-settings"></i> Company Settings</h4>
                        @include('layouts.partials.alerts')
                        <hr>
                        <form action="/company-store" class="form-horizontal"
                        method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        @if ($errors->any())
                        <div class="form-group">
                            <div class="alert alert-danger col-md-12">
                                {{ $errors->first() }}
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                                <label for="pwd1">Company Name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="far fa-building"></i>
                                        </span>
                                    </div>
                                <input type="text" class="form-control" name="company_name">
                                </div>
                        </div>
                        <div class="form-group">
                                <label for="file">Upload Company Logo</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                                <i class="fa fa-upload" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="file" name="company_picture" id="file" class="form-control" autofocus
                                    required>
                                <span class="help-block with-errors"></span>          
                                </div>
                        </div>
                        <hr>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> Save</button>
                            <a href="{{url('dashboard')}}">
                                    <button type="button" class="btn btn-inverse">Cancel</button>
                            </a>
                        </div>  
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</section>
@endsection