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
                            <h3 class="text-themecolor">Attendance Report</h3>
                        </div>
                        <div class="col-md-12 col-8 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item">Employee Report</li>
                                <li class="breadcrumb-item active">Attendance Report</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- main content --}}
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Attendance Report Summary</h4>
                <div class="table-responsive m-t-40">
                    <table id="example23" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th> Name</th>
                                <th> Position</th>
                                <th>Date</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Attendance Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0?>
                            @foreach ($data_att as $d)
                            <?php $no++?>
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$d->name_att}}</td>
                                <td>{{$d->position_name}}</td>
                                <td>{{ \Carbon\Carbon::parse($d->date)->format('d F Y')}}</td>
                                <td>{{\Carbon\Carbon::parse($d->check_in)->format('H:i')}}</td>
                                <td>{{\Carbon\Carbon::parse($d->check_out)->format('H:i')}}</td>
                                <td>{{$d->att_status}}</td>
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
    </script>
</section>
@endsection