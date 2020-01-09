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
                            <h3 class="text-themecolor">Leave Type Master </h3>
                        </div>
                        <div class="col-md-12 col-8 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item ">Payroll Master </li>
                                <li class="breadcrumb-item active">Leave Type Master </li>
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
                        <h4 class="modal-title"><i class="fa fa-plus"></i> Add New Leave Type</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span> </button>
                    </div>
                    <div class="modal-body">
                        <form role="form" action="/masterdata-payrollmaster-leavetypemaster-store" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label style="font-size: medium">Level Type Name<b style="color: red">*</b></label>
                                <input type="text" class="form-control" name="leave_type_name" required>
                            </div>
                            <div class="form-group">
                                <label style="font-size: medium">Day Amount<b style="color: red">*</b></label>
                                <input type="text" class="form-control" name="day_amount" id="rupiah" required>
                            </div>
                            <P>[<b style="color: red">*</b>]<b> Mendatory Data</b></P>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <button type="submit" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal -->
        <!-- .modal for edit salary -->
        @foreach ($leave_type as $leave)
        <div class="modal fade" id="myModalEdit-{{$leave->id}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Salary Level</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span> </button>
                    </div>
                    <div class="modal-body">
                            <form role="form" action="{{ url('/masterdata-payrollmaster-leavetypemaster-edit/'.$leave->id) }}"
                                method="post">
                            {{csrf_field()}}  
                            <div class="form-group">
                                <label style="font-size: medium">Level Name<b style="color: red">*</b></label>
                                <input type="text" class="form-control" name="leave_type_name" value="{{$leave->leave_type_name}}" required>
                            </div>
                            <div class="form-group">
                                <label style="font-size: medium">Day Amount<b style="color: red">*</b></label>
                                <input type="text" class="form-control" name="day_amount" value="{{$leave->day_amount}}"  required >
                            </div>
                            <P>[<b style="color: red">*</b>]<b> Mendatory Data</b></P>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Save</button>
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
                    <a style="color: white" data-toggle="modal" data-target="#myModal"
                        class="float-right btn-sm btn-default btn-success"> <i class="fa fa-plus-circle"></i> Add New
                        Leave Type
                    </a>
                </div>
                <h4 class="card-title">Leave Type Master</h4>
                <h6 class="card-subtitle">View Data Leave Type</h6>
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
                                <th>Leave Type Name</th>
                                <th>Day Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0?>
                            @foreach ($leave_type as $leave)
                            <?php $no++?>
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{ $leave->leave_type_name }}</td>
                                <td>{{ $leave->day_amount}}</td>
                                <td>
                                    <span data-toggle="tooltip" data-target="#id" title="Edit">
                                        <a href="#myModalEdit-{{$leave->id}}" data-toggle="modal"><i
                                                class="fa fa-edit"></i></a>
                                    </span>
                                    <span data-toggle="tooltip" data-target="#id" title="Delete">
                                        <a href="#modalDeleteAlert-{{$leave->id}}" data-toggle="modal"
                                            style="margin-right:5px;"><i class="fa fa-trash"></i></a>
                                    </span>
                                </td>
                            </tr>
                            <div class="modal fade" id="modalDeleteAlert-{{$leave->id}}" tabindex="-1" role="dialog"
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
                                                <strong>{{$leave->leave_type_name}}</strong> ?</h4>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{url("masterdata-payrollmaster-leavetypemaster-delete/$leave->id")}}"><button type="button"
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