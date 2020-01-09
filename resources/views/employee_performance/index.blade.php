@extends('layouts.app-spinner')
@section('content')
<section class="content">

    <head>
        <!-- chartist CSS -->
        <link href="../plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
        <link href="../plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
        <link href="../plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    </head>

    <body>
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
                            <h3 class="text-themecolor">Employee Performance</h3>
                        </div>
                        <div class="col-md-12 col-8 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Employee Performance</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">  
                    <div class="card-body">
                        <h4 class="card-title">Value Performance</h4>
                        <h6 class="card-subtitle">Filter by Year : 
                            <select name="" id="filter-tahun" onchange="changeYear(this)" class="form-control" style="width: 20%">
                                <option value="{{\Carbon\Carbon::now()->year}}">{{\Carbon\Carbon::now()->year}}</option>
                                <option value="{{\Carbon\Carbon::now()->year-1}}">{{\Carbon\Carbon::now()->year-1}}</option>
                                <option value="{{\Carbon\Carbon::now()->year-2}}">{{\Carbon\Carbon::now()->year-2}}</option>
                            </select>
                        </h6>
                        <hr>
                        <div class="ct-area-ln-chart" style="height: 400px;"></div>
                        <hr>
                        <div>
                            <h6 class="text-muted text-info"><i class="fa fa-circle font-10 m-r-10"></i> Performance
                                Information</h6>
                            <h6>Range [8 - 10] : <button class="btn btn-sm btn-rounded btn-success">EXCELLENT</button>
                            </h6>
                            <h6>Range [5 - 8] : <button class="btn btn-sm btn-rounded btn-info">GOOD</button></h6>
                            <h6>Range [0 - 5] : <button class="btn btn-sm btn-rounded btn-danger">BAD</button></h6>
                        </div>
                        {{-- <div class="float-right" style="bottom: 125px;position: relative">
                            <h6 class="text-muted text-info"><i class="fa fa-circle font-10 m-r-10"></i>Last Month
                                Performance Results</h6>
                    
                            @if($last_perf >= 0 && $last_perf <= 5) 
                                <h1 style="text-align: center">
                                    <button class="btn btn-sm btn-default btn-danger" style="color: white">BAD</button>
                                </h1>
                            @elseif($last_perf > 5 && $last_perf <= 8)
                                <h1 style="text-align: center">
                                    <button class="btn btn-sm btn-default btn-info" style="color: white">GOOD</button>
                                </h1>
                            @else
                                <h1 style="text-align: center">
                                    <button class="btn btn-sm btn-default btn-success" style="color: white">EXCELLENT</button>
                                </h1>
                            @endif
                            
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- chartist chart -->
        <script src="../plugins/chartist-js/dist/chartist.min.js"></script>
        <script src="../plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
        <script src="../plugins/chartist-js/dist/chartist-init.js"></script>
    </body>
</section>

<script>
    var year;
    $(document).ready(()=>{
        $('#filter-tahun').trigger('change');
    });
    function loadData() {
        $.ajax({
            url : window.location.origin+'/api/employee-performance/'+year,
            method : 'get',
            async : false,
            success:(response) => {
                var emp_perf = response;
                var month = [];
                var performance_val = [];
                for(var i = 0 ; i < emp_perf.length ; i++){
                    month.splice(i, 0, emp_perf[i].month);
                    performance_val.push(emp_perf[i].performance_val);
                }
                new Chartist.Line('.ct-area-ln-chart', {
                        labels: month,
                        series: [
                            performance_val
                        ]
                    },
                    {
                        axisY: {
                            type: Chartist.FixedScaleAxis,
                            ticks: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                            low: 0,
                            high: 10,
                        },
                        plugins: [
                            Chartist.plugins.tooltip()
                        ],
                        showArea: true
                    });
            }
        });
    }
    function changeYear(e) {
        year = $(e).val();
        loadData();
    }
</script>
@endsection
