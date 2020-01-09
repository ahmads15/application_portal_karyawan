@extends('layouts.app-spinner')
@section('content')

@can('Approval')
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
                            <h3 class="text-themecolor">Approval </h3>
                        </div>
                        <div class="col-md-12 col-8 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Approval</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- .modal for overtime -->
        @foreach ($sub_leaves as $sb)
        <div class="modal fade" id="leaves-{{$sb->id}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"> Leaves Submission</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span> </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('update-leaves-sub')}}" method="post" class="form-horizontal" data-toggle="validator">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label style="font-size: medium">Leave Type
                                </label>
                                <input type="text" class="form-control" name="name" value="{{$sb->leave_type_name}}"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label style="font-size: medium">Start Date
                                </label>
                                <input type="text" class="form-control" name="name" value="{{$sb->start_date}}"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label style="font-size: medium">End Date
                                </label>
                                <input type="text" class="form-control" name="name" value="{{$sb->end_date}}" readonly>
                            </div>
                            <div class="form-group">
                                <label style="font-size: medium"> Leave Duration
                                </label>
                                <input type="text" class="form-control" name="name" value="{{$sb->day_amount_sub}}"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label style="font-size: medium">Reason<b style="color: red">*</b></label>
                                <textarea name="reason" class="form-control" cols="30" rows="10"
                                    readonly>{{$sb->reason}} </textarea>
                            </div>
                            @if(Auth::user()->id == $sb->recv_id)
                            <div class="form-group">
                                <label style="font-size: medium">Notes<b style="color: red">*</b></label>
                                <textarea name="reason" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                            <div class="modal-footer" style="text-align: center">
                            <input type="hidden" name="id" value="{{$sb->id}}">
                                <button type="submit" name="approved" value="approved" class="btn btn-success"> Approve</button>
                                <button type="submit" name="rejected" value="rejected" class="btn btn-danger">Reject</button>
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        @foreach ($sub_overtime as $so)
        <div class="modal fade" id="overtime-{{$so->id}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"> Leaves Submission</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span> </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('update-overtime-sub')}}" method="post" class="form-horizontal" data-toggle="validator">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label style="font-size: medium">Overtime Date
                                </label>
                                <input type="text" class="form-control" name="name" value="{{$so->date}}"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label style="font-size: medium">Start Time
                                </label>
                                <input type="text" class="form-control" name="name" value="{{$so->start_time}}"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label style="font-size: medium">End Time
                                </label>
                                <input type="text" class="form-control" name="name" value="{{$so->end_time}}" readonly>
                            </div>
                            <div class="form-group">
                                <label style="font-size: medium"> Hour Duration
                                </label>
                                <input type="text" class="form-control" name="name" value="{{$so->hours}}"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label style="font-size: medium">Reason<b style="color: red">*</b></label>
                                <textarea name="reason" class="form-control" cols="30" rows="10"
                                    readonly>{{$so->overtime_reason}} </textarea>
                            </div>
                            @if(Auth::user()->id == $so->recv_id)
                            <div class="form-group">
                                <label style="font-size: medium">Notes<b style="color: red">*</b></label>
                                <textarea name="reason" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                            <div class="modal-footer" style="text-align: center">
                            <input type="hidden" name="id" value="{{$so->id}}">
                                <button type="submit" name="approved" value="approved" class="btn btn-success"> Approve</button>
                                <button type="submit" name="rejected" value="rejected" class="btn btn-danger">Reject</button>
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Approval</h4>
                <h6 class="card-subtitle">View status submissions</h6>
                @include('layouts.partials.alerts')
                @if ($errors->any())
                <div class="form-group">
                    <div class="alert alert-danger col-md-12">
                        {{ $errors->first() }}
                    </div>
                </div>
                @endif
                <div class="table-responsive m-t-40">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Submissions Date</th>
                                <th>Last Update</th>
                                <th>Name of applicant</th>
                                <th>Name of receiver</th>
                                <th>Submissions Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i =  0?>
                            @foreach ($sub_leaves as $sb)
                            <?php $i++?>
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$sb->created_at}}</td>
                                <td>{{$sb->updated_at}}</td>
                                <td>{{$sb->send_name}}</td>
                                <td>{{$sb->recv_name}}</td>
                                <td>Leaves</td>
                                <td>
                                    @if($sb->status == 'Pending')
                                    <span class="label label-warning">Pending</span>
                                    @elseif($sb->status == 'Approved')
                                    <span class="label label-success">Approved</span>
                                    @else
                                    <span class="label label-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="tools">
                                        {{-- <a href="#" onclick="departmentFormEdit()" data-toggle="tooltip" title="Edit" style="margin-right:5px;"><i class="fa fa-edit"></i></a> --}}
                                        <span data-toggle="tooltip" data-target="#id" title="">
                                            <a href="#leaves-{{$sb->id}}" data-toggle="modal"
                                                style="margin-right:5px;"><i class="fa fa-eye"></i> Detail</a>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @foreach ($sub_overtime as $so)
                            <?php $i++?>
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$so->created_at}}</td>
                                <td>{{$so->updated_at}}</td>
                                <td>{{$so->send_name}}</td>
                                <td>{{$so->recv_name}}</td>
                                <td>Overtime</td>
                                <td>
                                    @if($so->status == 'Pending')
                                    <span class="label label-warning">Pending</span>
                                    @elseif($so->status == 'Approved')
                                    <span class="label label-success">Approved</span>
                                    @else
                                    <span class="label label-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="tools">
                                        {{-- <a href="#" onclick="departmentFormEdit()" data-toggle="tooltip" title="Edit" style="margin-right:5px;"><i class="fa fa-edit"></i></a> --}}
                                        <span data-toggle="tooltip" data-target="#id" title="">
                                            <a href="#overtime-{{$so->id}}" data-toggle="modal"
                                                style="margin-right:5px;"><i class="fa fa-eye"></i> Detail</a>
                                        </span>
                                    </div>
                                </td>
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
                });
                function eximForm(){
                $('#modal-exim').modal('show');
                $('#modal-exim form')[0].reset();
            }
            
    </script>

    @endcan
    @endsection