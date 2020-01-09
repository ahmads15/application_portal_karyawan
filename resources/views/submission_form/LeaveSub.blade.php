@extends('layouts.app-spinner')
@section('content')


<section class="content">
  @include('sweet::alert')
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
                <li class="breadcrumb-item active">Leave Submissions</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
 
    </div>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title" style="text-align: center">Leave Submission</h4>
            <hr>
            @if(!$errors->isEmpty())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>{{$errors->first()}}</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif
            @include('layouts.partials.alerts')
            <form action="{{url('SubmissionForm-leaveSubmission-store')}}" method="post"
              class="floating-labels m-t-40 ">
              {{csrf_field()}}  
              <div class="form-group m-b-40">
                <select id="leave-type" name="leave_type" class="form-control p-0" id="input6" value="{{old('leave_type')}}">
                  @foreach($leave_types as $data)
                  <option value="{{$data->id}}" data-lenght="{{$data->day_amount}}">{{$data->leave_type_name}}</option>
                  @endforeach
                </select><span class="bar"></span>
                <label for="input6">Leave Type</label>
              </div>

              <div>
                <label class="form-group m-b-10">Start Date</label>
                <div class="input-group" id="wrap_leave_duration">
                  <input type="text" class="form-control" id="start_date" name="start_date" autocomplete="off">
                  <span class="input-group-btn">
                  </span>
                </div>
              </div>
              <br>

              <div>
                <label class="form-group m-b-10">End Date</label>
                <div class="input-group" id="wrap_leave_duration">
                  <input type="text" class="form-control" id="end_date" name="end_date" autocomplete="off">
                  <span class="input-group-btn">
                  </span>
                </div>
              </div>

              <br>
              <div id="div-ld">
                <label class="form-group m-b-10">Leave Durations</label>
                <div class="input-group" id="wrap_leave_duration">
                  <input name="leave_duration" class="form-control" value="{{old('leave_duration')}}" readonly>
                  <span class="input-group-btn">
                    <div class="input-group-append">
                      <button class="btn btn-success" type="button" onclick="checkLeave(this)">Check</button>
                    </div>
                  </span>
                </div>
              </div>

              <br>
              <div class="form-group m-b-5">
                <textarea class="form-control" rows="4" id="input7" name="reason">{{old('reason')}}</textarea>
                <span class="bar"></span>
                <label for="input7">Reasons</label>
              </div>
              <br>
              <button class="btn btn-success" type="submit">Save</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script>
      var range = 0, isCustomLeave = true, leave_type_id = 1;
        function changeMaxDay(e) {
            var selected = $(e).val();
            if (e.value === '1') isCustomLeave = true;
            else isCustomLeave = false;
            leave_type_id = e.value;
            maxDays = $('select[name="leave_type"] option[value="'+selected+'"]').data('lenght');
        }
        
        function countWeekendDays( d0, d1 )
        {
            var ndays = 1 + Math.round((d1.getTime()-d0.getTime())/(24*3600*1000));
            var nsaturdays = Math.floor((d0.getDay() + ndays) / 7);
            return 2*nsaturdays + (d0.getDay()==0) - (d1.getDay()==6);
        }

        var start_date = $('input[name=start_date]');
        var end_date = $('input[name=end_date]');
        var leave_duration = $('input[name=leave_duration]');

        $('#start_date').datepicker({
          autoclose : 'true',
        });
        $('#end_date').datepicker({
          autoclose : 'true'
        });

        $('input[name=start_date], input[name=end_date]').change(function () {
            // Date Difference Calculation
            var start_val = new Date(start_date.val());
            var end_val = new Date(end_date.val());

            var count_week_days = countWeekendDays(start_val, end_val);

            var date_diff = Math.round((end_val-start_val)/(1000*60*60*24)+1-count_week_days)

            leave_duration.val(date_diff);

            range = date_diff;
        });

        $('#leave-type').change(function (){
          if(($(this).val()) !== '1'){
            $('#div-ld').hide();
          }
          else{
            $('#div-ld').show();
          }
        });

        function checkLeave() {
            if(isCustomLeave === false) swal('Leave Type','Please check you leave type', 'info');
            else {
                send_check_leave('leaveSub-check', leave_type_id, range);
            }
        }
        function send_check_leave(url, type, duration) {
            $.ajax({
                url : url,
                method : 'POST',
                data : {
                    _token : "{{ csrf_token() }}",
                    leave_type_id : type,
                    durasi : duration,
                    start_date : $('input[name="start_date"]').val(),
                    end_date : $('input[name="end_date"]').val(),
                },
                success: function (response) {
                  console.log(response);
                  $('input[name="leave_duration"]').val(response.diff);
                  swal(response['alert-type']+'',response.message+'',response['alert-type']);
                },
                error: function (data) {
                  var error = data.responseJSON;
                  $('input[name="leave_duration"]').val(error.diff);
                  swal(error['alert-type']+'',error.message+'',error['alert-type']);
                }
            })
        }
    </script>
  </body>
</section>


@endsection