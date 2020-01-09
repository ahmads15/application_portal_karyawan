@extends('layouts.app-spinner')
@section('content')
@include('sweet::alert')

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
                            <h3 class="text-themecolor">Submission Form</h3>
                        </div>
                        <div class="col-md-12 col-8 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item">Submission Form</li>
                                <li class="breadcrumb-item active">Overtime Submissions</li>
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
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style="text-align: center">Overtime Submission</h4>
                        <hr>
                        @include('layouts.partials.alerts')
                        <form action="{{url('SubmissionForm-overSubmission-store')}}" method="post"
                            class="form-material m-t-40 ">
                            {{csrf_field()}}
                            <div class="form-group m-b-10">
                                <label for="input8">Overtime Date</label>
                                <div class='input-group mb-3'>
                                    <input name="date" type='text' class="form-control singledate" />
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <span class="ti-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-b-10">
                                <label class="input8">Start Time</label>
                                <div class="input-group clockpicker " data-placement="bottom" data-align="top"
                                    data-autoclose="true">
                                    <input name="start_time" id="start-time" type="text" class="form-control" value="" autocomplete="off">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="far fa-clock"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-b-10">
                                <label class="input8">End Time</label>
                                <div class="input-group clockpicker " data-placement="bottom" data-align="top"
                                    data-autoclose="true">
                                    <input name="end_time" id="end-time" type="text" class="form-control" value="" autocomplete="off">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="far fa-clock"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-b-10">
                                <label class="input8">Hour Duration</label>
                                <div class="input-group" id="wrap_leave_duration">
                                    <input name="hour_duration" class="form-control" value="{{old('hour_duration')}}"
                                        readonly>
                                </div>
                            </div>

                            <div class="form-group m-b-10">
                                <label for="input7">Reasons</label>
                                <textarea class="form-control" rows="4" id="input7"
                                    name="reason">{{old('reason')}}</textarea>
                            </div>
                            <br>
                            <br>
                            <button class="btn btn-success" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        $('.singledate').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true
    });  
    </script>
    <script>
        function timeDiff(time1, time2){
            var date1 = new Date('01/01/2019 '+time1);
            var date2 = new Date('01/01/2019 '+time2);

            var diff = date2.getTime() - date1.getTime();
            
            var msec = diff;
            
            var hh = Math.floor(msec / 1000 / 60 / 60);
            msec -= hh * 1000 * 60 * 60;
            var mm = Math.floor(msec / 1000 / 60);
            msec -= mm * 1000 * 60;
            var ss = Math.floor(msec / 1000);
            msec -= ss * 1000;

            if((hh.toString()).length < 2){
                hh = '0'+hh;
            }
            if((mm.toString()).length < 2){
                mm = '0'+mm;
            }

            return (hh + ":" + mm);
        }

    </script>
    <script>
        // Clock pickers
$('#single-input').clockpicker({
                    placement: 'bottom',
                    align: 'left',
                    autoclose: true,
                    'default': 'now',
                    twelvehour: true
                });
                $('.clockpicker').clockpicker({
                    donetext: 'Done',
                }).find('input').change(function () {
                    var time1 = $('#start-time').val();
                    var time2 = $('#end-time').val();

                    var hour_dur = timeDiff(time1, time2);

                    if(hour_dur.substr(0, 1) === '-'){
                        hour_dur = (timeDiff(time1, time2)).replace('-', '');
                        hour_dur = timeDiff(hour_dur, '24:00');
                    }
                    
                    $('input[name="hour_duration"]').val(hour_dur);
                });
                $('#check-minutes').click(function (e) {
                    // Have to stop propagation here
                    e.stopPropagation();
                    input.clockpicker('show').clockpicker('toggleView', 'minutes');
                });
                if (/mobile/i.test(navigator.userAgent)) {
                    $('input').prop('readOnly', true);
                }
    </script>
    <script>
        // clockpicker css
    <link href="../assets/plugins/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    </script>
    <script src="../assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

    <script src="../assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>

    <script src="../assets/plugins/daterangepicker/daterangepicker.js"></script>


    {{-- singleDatePicker --}}

</section>


@endsection