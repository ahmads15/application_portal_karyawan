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
                            <h3 class="text-themecolor">Position Master </h3>
                        </div>
                        <div class="col-md-12 col-8 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item ">Employee Master By HRD </li>
                                <li class="breadcrumb-item active">Position Master </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- .modal for add salary -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-plus"></i> Add New Position</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span> </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('add-position')}}" method="post" class="form-horizontal"
                            data-toggle="validator">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label style="font-size: medium">Department Name<b style="color: red">*</b></label>
                                <select name="department_name" id="" class="form-control">
                                    <option value="">-Select Department-</option>
                                    @foreach ($departments as $d)
                                    <option value="{{$d->id}}">{{$d->department_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label style="font-size: medium">Position Name<b style="color: red">*</b></label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <P>[<b style="color: red">*</b>]<b> Mendatory Data</b></P>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                <button type="submit" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal -->
        <!-- .modal for edit salary -->
        @foreach ($position as $p)
        <div class="modal fade" id="myModalEdit-{{$p->id}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Position</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span> </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('edit-position/'.$p->id)}}" method="post" class="form-horizontal"
                            data-toggle="validator">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label style="font-size: medium">Department Name<b style="color: red">*</b></label>
                                <select name="department_name" id="" class="form-control">
                                    <option value="{{$p->department_id}}">{{$p->department_name}}</option>
                                    @foreach ($departments as $d)
                                    <option value="{{$d->id}}">{{$d->department_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label style="font-size: medium">Position Name<b style="color: red">*</b></label>
                                <input type="text" class="form-control" name="position_name" value="{{$p->position_name}}"
                                    required>
                            </div>
                            <P>[<b style="color: red">*</b>]<b> Mendatory Data</b></P>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success"> Save</button>
                                <button type="submit" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <!-- /.modal -->
        <div class="card">
            <div class="card-body">
                <div>
                    <button class="float-right btn btn-sm btn-rounded btn-success" data-toggle="modal"
                        data-target="#myModal">Add New Position</button>
                </div>
                <h4 class="card-title">Position Master</h4>
                <h6 class="card-subtitle">View Data Position</h6>
                @include('layouts.partials.alerts')
                @if ($errors->any())
                <div class="form-group">
                    <div class="alert alert-danger col-md-12">
                        {{ $errors->first() }}
                    </div>
                </div>
                @endif
                <div class="table-responsive m-t-40">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Department Name</th>
                                <th>Position Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0?>
                            @foreach ($position as $p)
                            <?php $no++?>
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$p->department_name}}</td>
                                <td>{{$p->position_name}}</td>
                                <td>
                                    <span data-toggle="tooltip" data-target="#id" title="Edit">
                                        <a href="#myModalEdit-{{$p->id}}" data-toggle="modal"><i
                                                class="fa fa-edit"></i></a>
                                    </span>
                                    <span data-toggle="tooltip" data-target="#id" title="Delete">
                                        <a href="#modalDeleteAlert-{{$p->id}}" data-toggle="modal"
                                            style="margin-right:5px;"><i class="fa fa-trash"></i></a>
                                    </span>
                                </td>
                            </tr>
                            <div class="modal fade" id="modalDeleteAlert-{{$p->id}}" tabindex="-1" role="dialog"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><i class="fa fa-exclamation-triangle"
                                                    style="color: orange;border-bottom: red" aria-hidden="true"></i>
                                                Delete Account</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span> </button>
                                        </div>
                                        <div class="modal-body">
                                            <h4>Are you sure you want to delete
                                                <strong>{{$p->position_name}}</strong> ?</h4>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{url("delete-position/$p->id")}}"><button type="button"
                                                    class="btn btn-success">Yes</button></a>
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">No</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
    <script>
        $(function () {
                $('#myTable').DataTable();
                });
                function eximForm(){
                $('#modal-exim').modal('show');
                $('#modal-exim form')[0].reset();
            }
            
    </script>

    @endsection