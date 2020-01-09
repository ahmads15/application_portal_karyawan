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
                            <h3 class="text-themecolor">Attendance</h3>
                        </div>
                        <div class="col-md-12 col-8 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Attendance</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="round round-lg align-self-center round-info"><i
                                    class="mdi mdi-calendar-check"></i></div>
                            <div class="m-l-10 align-self-center">
                                <h3 class="m-b-0 font-light">{{Auth::user()->default_leave}} Days</h3>
                                <h5 class="text-muted m-b-0">Leave Amount</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="round round-lg align-self-center round-info"><i
                                    class="mdi mdi-clock-out"></i></div>
                            <div class="m-l-10 align-self-center">  
                                <h3 class="m-b-0 font-light">01 Hours</h3>
                                <h5 class="text-muted m-b-0">Overtime Total</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="round round-lg align-self-center round-primary"><i class="ti-bar-chart"></i>
                            </div>
                            <div class="m-l-10 align-self-center">
                                <h3 class="m-b-0 font-lgiht">
                                    @if(count($last_perf) > 0)
                                        @if($last_perf[0]->performance >= 0 && $last_perf[0]->performance <= 5)
                                            BAD
                                        @elseif($last_perf[0]->performance > 5 && $last_perf[0]->performance <= 8)
                                            GOOD
                                        @else
                                            EXCELLENT
                                        @endif
                                    @endif
                                </h3>
                                <h5 class="text-muted m-b-0">Last Month's Performance Result</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Summary Attendance</h4>
                <hr>
                <div class="table-responsive m-t-40">
                    <table id="example23" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0?>
                            @foreach ($data_absen as $da)
                            <?php $no++?>
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{\Carbon\Carbon::parse($da->date)->format('d F Y')}}</td>
                                <td>{{$da->check_in}}</td>
                                <td>{{$da->check_out}}</td>
                                <td>{{$da->attendance_status}}</td>
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

            
        $.ajax({
            url : window.location.origin + '/Reporting-TotalOvertime',
            method : 'get',
            success: (response) => {
                var total = '00:00';
                for(var i = 0 ;i< response.length;i++) {
                    total = timeAdd(total, response[i].hours);
                }
                $('#total_overtime').text(total.substr(0,2) + ' Hours');
            }
        });
    </script>
</section>
@endsection