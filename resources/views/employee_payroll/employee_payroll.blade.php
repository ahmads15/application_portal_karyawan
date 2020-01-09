@extends('layouts.app-spinner')
@section('content')

@can('Employee Payroll')
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
                            <h3 class="text-themecolor">Employee Payroll</h3>
                        </div>  
                        <div class="col-md-12 col-8 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item">Employee Report</li>
                                <li class="breadcrumb-item active">Employee Payroll</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- main content --}}
        <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Employee Payroll</h4>
                    <div class="table-responsive m-t-40">
                        <table id="EmployeeData" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th> Employee ID</th>
                                    <th> Name</th>
                                    <th> Position</th>
                                    <th> Employee Status</th>
                                    <th> Action</th>
                                </tr>
                            </thead>
                            <?php $no = 0?>
                            <tbody>
                                @foreach($data_user as $index => $value)
                                    <tr>
                                        <td>{{$index + 1}}</td>
                                        <td>{{$value->nip}}</td>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->position_name}}</td>
                                        <td>{{$value->status_karyawan}}</td>
                                        <td><a href="{{url('EmployeePayroll-EmployeeSubmitPayroll/'.$value->id)}}"><button class="btn btn-sm btn-default btn-success" type="button" style="color: white">Submit Salary</button></a></td>
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
                $('#EmployeeData').DataTable();
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
