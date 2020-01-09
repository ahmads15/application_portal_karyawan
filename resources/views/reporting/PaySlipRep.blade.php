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
                                <h3 class="text-themecolor">Payslip Report</h3>
                            </div>
                            <div class="col-md-12 col-8 align-self-center">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active">Reporting</li>
                                    <li class="breadcrumb-item active">Payslip report</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- row 1 --}}
            <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30">
                                        @if(Auth::user()->profile_picture == null)
                                        <img style="width: 50%" src="{{asset('images/user.png')}}" class="img-circle" width="10" />
                                        @else
                                        <img style="width: 50%" src="{{asset('images/profile/'.Auth::user()->profile_picture)}}"
                                        class="img-circle" width="10">
                                        @endif
                                    <h4 class="card-title m-t-10">{{$user->name}}</h4>
                                    {{-- <h6 class="card-subtitle">asdasd</h6> --}}
                                </center>
                            </div>
                            <div>
                                <hr> </div>
                            <div class="card-body"> 
                                <small class="text-muted">Company Name </small>
                                    <h6>{{$user->company_name}}</h6> 
                                <small class="text-muted p-t-10 db">Private Email address </small>
                                    <h6>{{$user->private_email}}</h6> 
                                <small class="text-muted p-t-10 db">Phone</small>
                                    <h6>{{$user->phone_number}}</h6> 
                                <small class="text-muted p-t-10 db">Address</small>
                                    <h6>{{$user->address}}</h6>
                                
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Nav tabs -->
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <!--second tab-->
                                <div  id="payslip" >
                                        <div class="card-body">
                                            <h4 class="card-title">Payslip Detail</h4>
                                            {{-- <h6 class="card-subtitle">Data table example</h6> --}}
                                            <div class="table-responsive m-t-40">
                                                <table id="paysliptable" class="table table-bordered table-striped" style="text-align: center">
                                                    <thead>
                                                        <tr>
                                                            <th>Month</th>
                                                            <th>Year</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($payslip as $data)
                                                            <tr>
                                                                <td>{{\Carbon\Carbon::createFromTimeString($data->updated_at)->format('M')}}</td>
                                                                <td>{{\Carbon\Carbon::createFromTimeString($data->updated_at)->format('Y')}}</td>
                                                                <td style="text-align: center"><a href="{{url('Reporting-PaySlipReport-PaySlipDetail/'.$data->id)}}"><button class="btn-sm btn-default btn-success" type="button" style="color: azure">Detail</button></a></td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
            {{-- /row 1 --}}
    </body>
</section>
<script>
    $(function () {
        $('#salarydetailtable').DataTable();
        $('#paysliptable').DataTable();
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
@endsection
