@extends('layouts.app-spinner')
@section('content')

<section>
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
                <h3 class="text-themecolor">Overtime Report</h3>
              </div>
              <div class="col-md-12 col-8 align-self-center">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                  <li class="breadcrumb-item ">Reporting</li>
                  <li class="breadcrumb-item ">Overtime Report</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-8">
          <div class="card">
            <div class="card-body">
              <div class="d-flex flex-row">
                <div class="round round-lg align-self-center round-info"><i class="mdi mdi-clock-out"></i></div>
                <div class="m-l-10 align-self-center">
                  <h3 class="m-b-0 font-light"><b id="total_overtime"></b></h3>
                  <h5 class="text-muted m-b-0">Overtime Total</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-8">
          <div class="card">
            <div class="card-body">
              <div class="d-flex flex-row">
                <div class="round round-lg align-self-center round-success"><i
                    class="mdi mdi-checkbox-multiple-marked"></i>
                </div>
                <div class="m-l-10 align-self-center">
                  <h3 class="m-b-0 font-light"><b>{{$total_overtime_approved}}</b></h3>
                  <h5 class="text-muted m-b-0">Approved</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body">
              <div class="d-flex flex-row">
                <div class="round round-lg align-self-center round-danger">
                  <i class="mdi mdi-close-circle-outline"></i>
                </div>
                <div class="m-l-10 align-self-center">
                  <h3 class="m-b-0 font-lgiht"> <b>{{$total_overtime_reject}}</b></h3>
                  <h5 class="text-muted m-b-0">Rejected </h5>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body">
              <div class="d-flex flex-row">
                <div class="round round-lg align-self-center round-warning">
                  <i class="fas fa-info-circle"></i>
                </div>
                <div class="m-l-10 align-self-center">
                  <h3 class="m-b-0 font-lgiht"><b >{{$total_overtime_pending}}</b></h3>
                  <h5 class="text-muted m-b-0">Pending</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
          <div class="card-body">
              <h4 class="card-title">Overtime History</h4>
              <div class="table-responsive m-t-40">
                <table id="myTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Date</th>
                      <th>Name of Sender</th>
                      <th>Start Time</th>
                      <th>End Time</th>
                      <th>Hours</th>
                      <th>Reason</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($overtime as $index => $value)
                        <tr>
                            <td>{{++$index}}</td>
                            <td>{{ \Carbon\Carbon::parse($value->date)->format('d F Y')}}</td>
                            <td>{{auth()->user()->name}}</td>
                            <td>{{$value->start_time}}</td>
                            <td>{{$value->end_time}}</td>
                            <td>{{substr($value->hours, 0,2)}} Hours</td>
                            <td>{{$value->overtime_reason}}</td>
                            <td><span class="label label-table label-{{($value->status == 'Approved' ? 'success' : ($value->status == 'Pending' ? 'warning' : 'danger'))}}">{{$value->status}}</span></td>
                            <td >
                                <span data-toggle="modal" data-target="#modal-OvertimeDetail">
                                    <button class="btn btn-sm btn-info" onclick="openModel({{$value->id}})" title="Edit" style="margin-right:5px;">Detail</button>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
        </div>
      </div>
      <div class="modal fade" id="modal-OvertimeDetail" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog"  role="document">
          <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Overtime Report Detail</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span> 
                </button>
              </div>  
                  <div class="modal-body">
                      <div class="card card-body">
                          <div class="row">
                              <div class="col-sm-12 col-xs-12">
                                  <form id="form-info-overtime">
                                      <div class="form-group">
                                          <label for="">Start Date</label>
                                          <input type="text" class="form-control" name="start_time" id="modal_start_date" placeholder="" disabled>
                                      </div>
                                      <div class="form-group">
                                          <label for="">End Date</label>
                                          <input type="text" class="form-control" name="end_time" id="modal_end_date" placeholder=" " disabled>
                                      </div>
                                      <div class="form-group">
                                          <label for="">Name of Sender</label>
                                          <input type="text" class="form-control" name="name_of_application" value="{{auth()->user()->name}}" placeholder="" disabled>
                                      </div>
                                      <div class="form-group">
                                          <label for="">Name of Receiver</label>
                                          <input type="text" class="form-control" name="supervisor" id="modal_supervisor" placeholder="" disabled>
                                      </div>
                                      <div class="form-group">
                                          <label for="">Status</label>
                                          <input type="text" class="form-control" name="status" id="modal_status" placeholder=" " disabled>
                                      </div>
                                      <div class="form-group">
                                          <label for="">Reason</label>
                                          <textarea name="reason" id="modal_reason" class="form-control" rows="5" disabled></textarea>
                                      </div>
                                      <div class="form-group">
                                          <label for="">Note</label>
                                          <textarea name="note" id="modal_note" class="form-control" rows="5" disabled></textarea>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
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

        function openModel (id) {
            $.ajax({
                url : window.location.origin + '/Reporting-DetailOvertime/'+id,
                method : 'get',
                success : function (response) {
                    var elements = document.getElementById('form-info-overtime').elements;
                    elements.start_time.value = response.start_time;
                    elements.end_time.value = response.end_time;
                    elements.supervisor.value = response.supervisor;
                    elements.status.value = response.status;
                    elements.reason.value = response.overtime_reason;
                    elements.note.value = response.note;
                },
            });
            $('#modal-OvertimeDetail').modal('show');
        }


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
        function timeAdd(time1, time2){
            var t1_h = time1.substr(0,2);
            var t1_m = time1.substr(3,2);

            var t2_h = time2.substr(0,2);
            var t2_m = time2.substr(3,2);

            var hh = (parseInt(t1_h)*60)+(parseInt(t2_h)*60);
            var mm = parseInt(t1_m)+parseInt(t2_m);

            var total_mm = hh+mm;
            var hh_x = Math.floor(total_mm/60);
            var mm_x = parseInt(total_mm)-parseInt(hh_x*60)

            if((hh_x.toString()).length < 2){
                hh_x = '0'+hh_x;
            }
            if((mm_x.toString()).length < 2){
                mm_x = '0'+mm_x;
            }

            return (hh_x + ":" + mm_x);
        }
    </script>
</section>

@endsection
