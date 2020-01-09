@extends('layouts.app-spinner')
@section('content')
@can('Employee Master by HRD')

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
                            <h3 class="text-themecolor">Employee Master Detail </h3>
                        </div>
                        <div class="col-md-12 col-8 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Employee Master Detail</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                {{-- <div class="float-right">
                    <a href="#" onclick="eximForm()" class="float-right btn-sm btn-default btn-success"
                        style="color: white">
                        <i class="mdi mdi-file-import"></i> Import Data
                    </a>
                </div> --}}
                <h4 class="card-title">Data Employee</h4>
                <h6 class="card-subtitle">View Data Employee</h6>
                @include('layouts.partials.alerts')
                {{-- modal export import --}}
                <div class="modal fade" id="modal-exim" tabindex="1" role="dialog" data-backdrop="static"
                    aria-hidden="true">
                    <div class="modal-dialog" modal-lg>
                        <div class="modal-content">
                            <form action="{{url('import-userAdmin')}}" method="post" class="form-horizontal"
                                data-toggle="validator" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="modal-header">
                                    <h4 class="modal-title">Import Users</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span> </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="file" class="col-md-6 control-label">Import</label>
                                        <div class="col-md-8">
                                            <input type="file" name="file" id="file" class="form-control" autofocus
                                                required>
                                            <span class="help-block with-errors"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-8 control-label" style="padding-left: 15px;">
                                            <a href="{{url('download-template-hrd')}}"><i class="fa fa-download"
                                                    aria-hidden="true"></i> Download Template with Data .xls</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success btn-save">Save</button>
                                    <button type="submit" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- end modal --}}
                @if($message = Session::get('error'))
                <?php 
                $err_msg = Session::get('error');
                $temp = explode("*", $err_msg);
                $temp_nip = $temp[0];
                $temp_email = $temp[1];
                
                $exp_nip = explode("-", $temp_nip);
                $exp_email = explode("-", $temp_email);
                ?>
                <p class="alert alert-danger">
                    @if($exp_nip[0] != "")
                    NIP : <br>
                    @foreach($exp_nip as $en)
                    {{ $en }} <br>
                    @endforeach
                    @endif
                    @if($exp_nip[0] != "" && $exp_email[0] != "")
                    <br>
                    @endif
                    @if($exp_email[0] != "")
                    Email : <br>
                    @foreach($exp_email as $em)
                    {{ $em }} <br>
                    @endforeach
                    @endif
                </p>
                @endif
                <div class="table-responsive m-t-40">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Employee ID</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Position</th>
                                <th>Employee Status</th>
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0?>
                            @foreach ($users as $user)
                            <?php $no++?>
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{ $user->nip }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->department_name }}</td>
                                <td>{{ $user->position_name }}</td>
                                <td>{{ $user->status_karyawan }}</td>
                                <td > 
                                    <div class="tools" style="text-align: center">
                                        <a href="{{url("edit-employee/$user->id")}}" data-toggle="tooltip" title="Edit"
                                            style="margin-right: 3px;"><i class="fa fa-edit"></i></a>
                                    </div>
                                </td>
                                
                            </tr>
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
            $(function () {
            var table = $('#example').DataTable({
            "columnDefs": [{
            "visible": false,
            "targets": 2
            }],
            "order": [
            [2, 'asc']
            ],
            "displayLength": 25,
            "drawCallback": function (settings) {
            var api = this.api();
            var rows = api.rows({
            page: 'current'
            }).nodes();
            var last = null;
            api.column(2, {
            page: 'current'
            }).data().each(function (group, i) {
            if (last !== group) {
            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
            last = group;
            }
            });
            }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function () {
            var currentOrder = table.order()[0];
            if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
            table.order([2, 'desc']).draw();
            } else {
            table.order([2, 'asc']).draw();
            }
            });
            });
            });
            $('#example23').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf'
            ]
            });
            function eximForm(){
            $('#modal-exim').modal('show');
            $('#modal-exim form')[0].reset();
        } 
    </script>


</section>


@endcan
@endsection