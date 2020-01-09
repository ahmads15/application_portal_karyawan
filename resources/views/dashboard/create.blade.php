@extends('layouts.app-spinner')
@section('content')
@can('News Master')

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
                            <h3 class="text-themecolor">Create News</h3>
                        </div>
                        <div class="col-md-12 col-8 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item "> News Master</li>
                                <li class="breadcrumb-item active">Create News</li>
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
                        <h4 class="card-title"> News</h4>
                        @include('layouts.partials.alerts')
                        <hr>
                        <form action="{{route('dashboard.store')}}" class="form-horizontal" method="POST"
                            enctype="multipart/form-data">
                            {{csrf_field()}}
                            @if ($errors->any())
                            <div class="form-group">
                                <div class="alert alert-danger col-md-12">
                                    {{ $errors->first() }}
                                </div>
                            </div>
                            @endif
                            <div class="form-group">
                                <label>Title</label>
                                <div class="input-group">
                                    <input type="text" name="title" class="form-control" placeholder="Enter title">
                                </div>
                            </div>
                            <div class="form-group" >
                                <label>Body</label>
                                <div class="input-group" >
                                    <textarea  class="summernote" name="body" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Footer</label>
                                <div class="input-group">
                                    <input type="text" name="footer" class="form-control" placeholder="Enter footer">
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-success"> Save</button>
                        </form>
                    </div>
                </div>
            </div>
    </body>
    <script>
        $(function () {
            $('.summernote').summernote({
                height: 350, // set editor height
                focus: false // set focus to editable area after initializing summernote
            });
            $('.inline-editor').summernote({
                airMode: true
            });
        });
        window.edit = function () {
            $(".click2edit").summernote()
        },
        window.save = function () {
            $(".click2edit").summernote('destroy');
        }
    </script>
</section>
@endcan
@endsection