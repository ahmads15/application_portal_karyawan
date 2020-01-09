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
                            <h3 class="text-themecolor">Employee Data</h3>
                        </div>
                        <div class="col-md-12 col-8 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Employee Data</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- /.left-aside-column-->
                        <div class="right-page-header">
                            <div class="d-flex">
                                <div class="align-self-center">
                                    <h4 class="card-title m-t-10"> Employee Data</h4>
                                </div>
                                <div class="ml-auto">
                                    <input type="text" id="demo-input-search2" placeholder="Search employee"
                                        class="form-control"> </div>
                            </div>
                        </div>
                        <hr>
                        <div >
                                <a style="color: white" href="{{url('export-user')}}" class="float-left btn-sm btn-default btn-success"> <i class="mdi mdi-file-export"></i> Export data to Excel (.xls)
                                </a> 
                            </div>
                        <div class="table-responsive">
                            <table id="demo-foo-addrow" class="table m-t-30 table-hover no-wrap contact-list"
                                data-paging="true" data-paging-size="10">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Private Email</th>
                                        <th>Phone</th>
                                        <th>Employee Status</th>
                                        <th>Salary Total</th>
                                        <th>Joining Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0?>
                                    @foreach($users as $user)
                                    <?php $no++?>
                                    <tr>
                                        <td>{{$no}}</td>
                                        <td>
                                                <a href="{{route('users.detail',$user->id)}}">
                                                @if($user->profile_picture == null)
                                                <img  src="{{asset('images/user.png')}}"
                                                    class="img-circle image" />
                                                @else
                                                <img 
                                                    src="{{asset('images/profile/'.$user->profile_picture)}}"
                                                    class="img-circle image">
                                                @endif
                                                {{$user->name}}</a>
                                        </td>
                                        <td>{{$user->private_email}}</td>
                                        <td>{{$user->phone_number}}</td>
                                        <td>{{ $user->status_karyawan }}</td>
                                        @if($user->total_salary == 0)
                                            <td>Rp - </td>
                                        @else
                                            <td>Rp.{{$user->total_salary}}</td>
                                        @endif
                                        <td>{{ $user->created_at->format('F d, Y')}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <div id="add-contact" class="modal fade in" tabindex="-1" role="dialog"
                                            aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Add New Contact</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <from class="form-horizontal form-material">
                                                            <div class="form-group">
                                                                <div class="col-md-12 m-b-20">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Type name"> </div>
                                                                <div class="col-md-12 m-b-20">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Email"> </div>
                                                                <div class="col-md-12 m-b-20">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Phone"> </div>
                                                                <div class="col-md-12 m-b-20">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Designation"> </div>
                                                                <div class="col-md-12 m-b-20">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Age"> </div>
                                                                <div class="col-md-12 m-b-20">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Date of joining"> </div>
                                                                <div class="col-md-12 m-b-20">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Salary"> </div>
                                                                <div class="col-md-12 m-b-20">
                                                                    <div
                                                                        class="fileupload btn btn-danger btn-rounded waves-effect waves-light">
                                                                        <span><i class="ion-upload m-r-5"></i>Upload
                                                                            Contact Image</span>
                                                                        <input type="file" class="upload"> </div>
                                                                </div>
                                                            </div>
                                                        </from>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-info waves-effect"
                                                            data-dismiss="modal">Save</button>
                                                        <button type="button" class="btn btn-default waves-effect"
                                                            data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <td colspan="7">
                                            <div class="text-right">
                                                <ul class="pagination"> </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>                              
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </body>
    {{-- <script>
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
    </script> --}}

    </body>
</section>


@endsection