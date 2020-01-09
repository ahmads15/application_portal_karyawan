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
                <h3 class="text-themecolor">Leave Report</h3>
              </div>
              <div class="col-md-12 col-8 align-self-center">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                  <li class="breadcrumb-item ">Reporting</li>
                  <li class="breadcrumb-item ">Leave Report</li>
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
              <div class="round round-lg align-self-center round-info"><i class="mdi mdi-calendar-check"></i></div>
              <div class="m-l-10 align-self-center">
                <h3 class="m-b-0 font-light">{{Auth::user()->default_leave}} Days</h3>
                <h5 class="text-muted m-b-0"> Leave Amount</h5>
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
                <h3 class="m-b-0 font-light">{{$leave_approved}}</h3>
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
                <h3 class="m-b-0 font-light">{{$leave_rejected}}</h3>
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
                <h3 class="m-b-0 font-lgiht">{{$leave_pending}}</h3>
                <h5 class="text-muted m-b-0">Pending</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Leave History</h4>
        {{-- <h6 class="card-subtitle">Data table example</h6> --}}
        <div class="table-responsive m-t-40">
            <table id="leavehistorytable" class="table table-bordered table-striped" style="text-align: center">
                <thead>
                    <tr>
                      <th >No</th>
                      <th >Leave Type</th>
                      <th >Name of Reciever</th>
                      <th >Start Date</th>
                      <th >End Date</th>
                      <th >Duration(Day)</th>                     
                      <th >Created Date</th>
                      <th >Last Updated</th>
                      <th >Status</th>
                      <th >Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0?>
                    @foreach($leaves as $index => $value)
                    <?php $no++?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$value->leave_type_name}}</td>
                            <td>{{$value->supervisor}}</td>
                            <td>{{ \Carbon\Carbon::parse($value->start_date)->format('d F Y')}}</td>
                            <td>{{ \Carbon\Carbon::parse($value->end_date)->format('d F Y')}}</td>
                            <td>{{$value->day_amount_sub}}</td>
                            <td>{{ \Carbon\Carbon::parse($value->created_date)->format('d F Y')}}</td>
                            <td>{{ \Carbon\Carbon::parse($value->updated_date)->format('d F Y')}}</td>
                            <td><span class="label label-table label-{{($value->status == 'Approved' ? 'success' : ($value->status == 'Pending' ? 'warning' : 'danger'))}}">{{$value->status}}</span></td>
                            <td >
                                {{-- <span data-toggle="modal" data-target="#modal-ApprovalDetail-{{$lh->id}}"> --}}
                                <span data-toggle="modal" data-target="#modal-LeaveReportDetail">
                                    <button class="btn btn-sm btn-info" onclick="showModal({{$value->id}})" title="Edit" data-toggle="" style="margin-right:5px;">Detail</button>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
    
    {{-- @foreach ($leavehistory as $lh) --}}
    <?php
      // $startDate = date('d M Y', strtotime($lh->startDate));
      // $endDate = date('d M Y', strtotime($lh->endDate));
    ?>
    <div class="modal fade" id="modal-LeaveReportDetail" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog"  role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Leave Report Detail</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span> 
              </button>
            </div>  
                <div class="modal-body">
                    <div class="card card-body" >
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form id="form-info-leaves">
                                    <div class="form-group">
                                        <label for="">Start Date</label>
                                        <input type="text" class="form-control" name="modal_start_date" id="" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="">End Date</label>
                                        <input type="text" class="form-control" name="modal_end_date" id="" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Name of Reciever</label>
                                        <input type="text" class="form-control" name="modal_supervisor" id=""  readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Leave Type</label>
                                        <input type="text" class="form-control" name="modal_leave_type_name" id=""  readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <input type="text" class="form-control" name="modal_status" id="" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Note</label>
                                        <textarea name="note" id="" class="form-control" rows="5"  readonly></textarea>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    {{-- @endforeach --}}
  </body>
  <script>
    $(function () {
        $('#salarydetailtable').DataTable();
        $('#leavehistorytable').DataTable();
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

    function showModal(id) {
        $.ajax({
            url : window.location.origin + '/Reporting-DetailLeave/'+id,
            method : 'get',
            success: (response) => {
                var element = document.getElementById('form-info-leaves').elements;
                element.modal_start_date.value = moment(response.start_date).format('LL');
                element.modal_end_date.value = moment(response.end_date).format('LL');
                element.modal_supervisor.value = response.supervisor;
                element.modal_leave_type_name.value = response.leave_type_name;
                element.modal_status.value = response.status;
                element.note.value = response.note;
            }
        });
        $('#modal-LeaveReportDetail').modal('show');

    }
</script>

</section>
@endsection
