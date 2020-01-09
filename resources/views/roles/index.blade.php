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
                            <h3 class="text-themecolor">Manage roles & permissions</h3>
                        </div>
                        <div class="col-md-12 col-8 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Roles & permissions</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div>
                    <a style="color: white" href="{{ URL::to('roles/create') }}"
                        class="float-right btn-sm btn-rounded btn-success"><i class="fas fa-plus"></i> Add
                        New Role</a>
                </div>
                <h4 class="card-title">Roles & permissions</h4>
                <h6 class="card-subtitle">Only IT Admin can manage permissions all users</h6>
                @include('layouts.partials.alerts')
                <div class="table-responsive m-t-40">
                    <form method="POST" action="{{url('roles-search')}}" class="form-group">
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
                                <th>Role</th>
                                <th>Permissions</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0?>
                            @foreach ($roles as $role)
                            <?php $no++?>
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>
                                <td>
                                    <a href="{{ URL::to('roles/'.$role->id.'/edit') }}" data-toggle="tooltip"
                                        title="Edit" style="margin-right: 3px;"><i class="fa fa-edit"></i></a>
                                        <span data-toggle="tooltip" data-target="#id" title="Delete">
                                                <a href="#modalDeleteAlert-{{$role->id}}" data-toggle="modal"
                                                    style="margin-right:5px;"><i class="fa fa-trash"></i></a>
                                        </span>
                                    {{-- {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) !!}
                                    {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit'] )  }}
                                    {!! Form::close() !!} --}}
                                </td>
                            </tr>
                            <div class="modal fade" id="modalDeleteAlert-{{$role->id}}" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><i class="fa fa-exclamation-triangle"
                                                        style="color: orange;border-bottom: red" aria-hidden="true"></i>
                                                    Confirmation</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span> </button>
                                            </div>
                                            <div class="modal-body">
                                                <h4>Are you sure you want to delete  <b> {{$role->name}} </b>?</h4>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{url("delete-role/$role->id")}}"><button type="button"
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
@endsection