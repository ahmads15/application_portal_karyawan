@extends('layouts.app-spinner')
@section('content')
@can('Employee Master by Admin')

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
                            <h3 class="text-themecolor">Employee Master by Admin</h3>
                        </div>
                        <div class="col-md-12 col-8 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Employee Master by Admin</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div >
                    <a style="color: white" href="{{ route ('users.create') }}" class="float-right btn-sm btn-rounded btn-success"> Add
                    User</a> 
                </div>
                <div style="margin-right: 75px">
                    <a href="#" onclick="eximForm()" class="float-right btn-sm btn-rounded btn-success"
                        style="color: white">
                        Export/Import
                    </a>
                </div>
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
                                    <h4 class="modal-title">Export/import Users</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span> </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <a href="{{url('export-userAdmin')}}">
                                                <label for="export" class="btn btn-success"><i
                                                        class="fas fa-file-excel"></i> Export Data .xls</label>
                                            </a>
                                            <span class="help-block with-errors"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="file" class="col-md-6 control-label">Import</label>
                                        <div class="col-md-8">
                                            <input type="file" name="file" id="file" class="form-control" autofocus
                                                required>
                                            <span class="help-block with-errors"></span>
                                        </div>
                                        <br>
                                        <p class="help-block col-md-5"><a href="{{ asset('images/upload-databyAdmin.png') }}" target="_blank"><i class="fas fa-upload"></i>  Excel Format</a></p>
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
                    <form method="POST" action="{{url('roles-search-employee')}}" class="form-group">
                                @csrf
                                <div class="row col-md-12">
                                    <div class="col-md-2">
                                        <select class="form-control" name="role_id">
                                            <option value="" selected disabled>-Select Role-</option>
                                            <option value="all">All</option>
                                            @if(isset($select_roles))
                                            @foreach ($select_roles as $sr)
                                            <option {{old('role_id') == $sr->id ? 'selected' : ''}} value="{{$sr->id}}">{{$sr->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-success" type="submit">Submit</button>
                                    </div>
                                </div>
                    </form>
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Company Name</th>
                                <th>Name</th>
                                <th>Email Company</th>
                                <th>Date/Time Added</th>
                                <th>Roles</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php $no = 0?>
                            @foreach ($users as $user)
                            <?php $no++?>
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{ $user->company_name}}</td>
                                <td>{{ $user->name }} </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('F d, Y h:ia')}}</td>
                                <td>{{ $user->roles()->pluck('name')->implode(' ') }}</td>
                                <td>
                                    <div class="tools" style="padding-left: 20px">
                                        <a href="{{route('users.edit',$user->id) }}" data-toggle="tooltip" title="Edit"
                                            style="margin-right: 3px;"><i class="fa fa-edit"></i></a>
                                        <span data-toggle="tooltip" data-target="#id" title="Delete">
                                            <a href="#modalDeleteAlert-{{$user->id}}" data-toggle="modal"
                                                style="margin-right:5px;"><i class="fa fa-trash"></i></a>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal fade" id="modalDeleteAlert-{{$user->id}}" tabindex="-1" role="dialog"
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
                                            <h4>Are you sure you want to delete the account
                                                <strong>{{$user->name}}</strong> ?</h4>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{url("delete-user/$user->id")}}"><button type="button"
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