@extends('layouts.app-spinner')
@section('content')

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
            <h3 class="text-themecolor">Pay Slip Detail</h3>
        </div>
        <div class="col-md-12 col-8 align-self-center">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item">Reporting</li>
            <li class="breadcrumb-item"><a href="{{ url('Reporting-PaySlipReport') }}">Pay Slip Report</a></li>
            <li class="breadcrumb-item active">Pay Slip Detail</li>
            </ol>
        </div>
        </div>
    </div>
    </div>
    @if(!$errors->isEmpty())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{$errors->first()}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
</div>
    <!-- Main content -->
        <div class="row">
                <div class="col-md-12">
                    <div class="card card-body printableArea">
                        <h3><b>PAY SLIP EMPLOYEE</b></h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-left">
                                    <address>
                                        <h4 class="font-bold">{{$user->company_name}}</h4>
                                    </address>
                                </div>
                                <div class="pull-right text-right">
                                    <address>
                                        <h3>To,</h3>
                                        <h4 class="font-bold">{{$user->name}}</h4>
                                        <p >Employee ID :{{$user->nip}}</p>
                                        <p>Bank :</b>  {{$user->bank_code}} - {{$user->bank_name}}</p>
                                        <p>Bank Account Number  :</b>  {{$user->no_rekening}}</p>
                                    </address>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive m-t-40" style="clear: both;">
                                    <table class="table table-hover">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Salary Component</th>
                                                <th class="text-right">Amount</th>
                                                {{-- <th class="text-right">Total</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <div class="d-none">{{$lastIndex = 0}}</div>
                                            @foreach($list_component as $index => $value)
                                                <tr>
                                                    <td class="text-center">{{++$index}}</td>
                                                    <td>{{$value->salary_component}}</td>
                                                    <td class="text-right"> Rp. {{number_format($value->salary_amount)}} </td>
                                                    {{-- <td class="text-right"> Rp. {{number_format($value->salary_amount)}} </td> --}}
                                                </tr>
                                                <div class="d-none">{{$lastIndex = ++$index}}</div>
                                            @endforeach
                                            <tr>
                                                <td class="text-center">{{$lastIndex}}</td>
                                                    <td>{{$salary_level->salary_level_name}}</td>
                                                    <td class="text-right"> Rp. {{$salary_level->salary_amount}} </td>
                                                    {{-- <td class="text-right"> Rp. {{$salary_level->salary_amount}} </td> --}}
                                            </tr>
                                            <tr class="table-secondary">
                                                <td class="text-center">{{$lastIndex+1}}</td>
                                                <td>Overtime</td>
                                                <td class="text-right">Rp.{{number_format($payslip_detail->overtime_hours)}}</td>
                                                {{-- <td class="text-right">Rp.{{number_format($payslip_detail->overtime_hours)}}</td> --}}
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">
                                {{-- <div class="pull-right m-t-30 text-right">
                                </div>
                                <hr> --}}
                                <h3 class="text-right">
                                    <b>Total : Rp. {{number_format($payslip_detail->total_salary)}}</b>
                                </h3>
                                <div class="clearfix"></div>
                                <hr>
                                <div class="text-right">
                                        <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!--Custom JavaScript -->
<script src={{asset("js/custom.min.js")}}></script>
<script src={{asset("js/jquery.PrintArea.js")}}></script>
<script>
$(document).ready(function() {
    $("#print").click(function() {
        var mode = 'iframe'; //popup
        var close = mode == "popup";
        var options = {
            mode: mode,
            popClose: close
        };
        $("div.printableArea").printArea(options);
    });
});
</script>
</body>
@endsection
