@extends('layouts.app-spinner')
@section('content')

@include('sweet::alert')


<section class="content">
    <style>
        h4 img {
            width: 100% !important;
        }

    </style>

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
                            <h3 class="text-themecolor">Dashboard</h3>
                        </div>
                        <div class="col-md-12 col-8 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.partials.alerts')
        <div class="row">
            <div class="col-lg-4 ">
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
                        <a href="{{url('Reporting-LeaveReport')}}">
                            <button class="float-right  btn btn-sm btn-outline-success">More info</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="round round-lg align-self-center round-warning"><i class="ti-alarm-clock"></i>
                            </div>
                            <div class="m-l-10 align-self-center">
                                <h3 class="m-b-0 font-lgiht" style="font-weight: bold;font-size: xx-large">
                                    <div id="timeDisplay"></div>
                                </h3>
                                <a href="">
                                    <h5 class="text-muted m-b-0">Attendance</h5>
                                </a>
                            </div>
                        </div>
                        <a href="" data-toggle="modal" data-target="#myAbsen">
                            <button class="float-right btn btn btn-sm btn-outline-success">More info</button>
                        </a>
                    </div>
                </div>
            </div>
            {{-- @hasanyrole('Supervisor|HRD')
            <div class="col-lg-4 col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="round round-lg align-self-center round-success"><i
                                    class="mdi mdi-checkbox-multiple-marked-outline"></i>
                            </div>
                            <div class="m-l-10 align-self-center">
                                <h3 class="m-b-0 font-light">BELOM BISA</h3>
                                <a href="">
                                    <h5 class="text-muted m-b-0">Approval</h5>
                                </a>
                            </div>
                        </div>
                        <a href="{{url('approval')}}">
                            <button class="float-right btn btn btn-sm btn-outline-success">More info</button>
                        </a>
                    </div>
                </div>
            </div>
            @endhasrole --}}
            @role('IT Administrator')
            <div class="col-lg-4 col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="round round-lg align-self-center round-success"><i
                                    class="mdi mdi-account-plus"></i>
                            </div>
                            <div class="m-l-10 align-self-center">
                                <h3 class="m-b-0 font-light">{{count($users)}}</h3>
                                <a href="">
                                    <h5 class="text-muted m-b-0">User Registrations</h5>
                                </a>
                            </div>
                        </div>
                        <a href="{{route('users.index')}}">
                            <button class="float-right btn btn btn-sm btn-outline-success">More info</button>
                        </a>
                    </div>
                </div>
            </div>
            @endrole
            @hasanyrole('Supervisor|HRD|Karyawan')
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="round round-lg align-self-center round-success"><i class="ti-bar-chart"></i>
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
                        <a href="{{url('employee-performance')}}">
                            <button class="float-right btn btn btn-sm btn-outline-success">More info</button>
                        </a>
                    </div>
                </div>
            </div>
            @endhasrole
        </div>
        {{-- News and To do List --}}
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> <i class="mdi mdi-newspaper"></i> News Stream</h4>
                        <h6 class="card-subtitle">Latest News for users from Admin</h6>
                        <!-- ============================================================== -->
                        <!-- To do list widgets -->
                        <!-- ============================================================== -->
                        <div>
                            @foreach ($news as $news1)
                            <ul>
                                <li>
                                    <div style="font-size: medium">
                                        <a href="" data-toggle="modal" data-target="#modalNews-{{$news1->id}}">
                                            <label>
                                                {{ $news1->title }}
                                            </label>
                                        </a>
                                        <br>
                                        <label>
                                            {{$news1->created_at->format(' d F Y, h:ia')}}
                                        </label>
                                    </div>
                                    {{-- modal news --}}
                                    <div class="modal fade" id="modalNews-{{$news1->id}}" role="dialog"
                                        aria-hidden="true" aria-labelledby="exampleModalScrollableTitle">
                                        <div class="modal-dialog modal-dialog-scrollable modal-md" role="document" >
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="exampleModalScrollableTitle"> 
                                                        <b>
                                                            {{$news1->title}}
                                                        </b>
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span> </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h4><strong> {{$news1->created_at->format(' d F Y, h:ia')}} |
                                                            Admin</strong></h4>
                                                    <br>
                                                    <h4>{!! $news1->body !!}</h4>
                                                    <br>
                                                </div>
                                                <div class="modal-footer">
                                                    <div style="padding-right: 230px">
                                                        {!! Form::open(['method' => 'DELETE', 'route' =>
                                                        ['dashboard.destroy', $news1->id] ]) !!}
                                                        {{-- @can('Edit News')
                                                                <a href="{{ route('dashboard.edit', $news1->id) }}"
                                                        class="btn
                                                        btn-info" role="button"><i class="fa fa-edit"></i></a>
                                                        @endcan --}}
                                                        @can('Delete News')
                                                        {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm'] )  }}
                                                        @endcan
                                                        {!! Form::close() !!}
                                                    </div>
                                                    <h4><strong>{{$news1->footer}}</strong></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end modal --}}
                                </li>
                            </ul>
                            @endforeach
                        </div>
                    </div>
                    {{$news->appends(['news' => $todo->currentPage()])->links()}}
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <button class="float-right btn btn-sm btn-rounded btn-success" data-toggle="modal"
                            data-target="#myModal">Add Todo</button>
                        <h4 class="card-title"><i class="mdi mdi-format-list-bulleted"></i> To Do list</h4>
                        <h6 class="card-subtitle">List of your todo </h6>
                        <!-- ============================================================== -->
                        <!-- To do list widgets -->
                        <!-- ============================================================== -->
                        <div class="to-do-widget m-t-20">
                            <!-- .modal for add task -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add Todo</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span> </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{url('add-todo')}}" class="form-horizontal" method="POST"
                                                enctype="multipart/form-data">
                                                {{csrf_field()}}
                                                <div class="form-group">
                                                    <label style="font-size: medium">Todo name</label>
                                                    <input type="text" class="form-control" name="todo" autocomplete="off"
                                                        placeholder="Enter Todo Name">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Submit</button>
                                                    <button type="submit" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.modal -->
                            <ul class="list-task todo-list list-group m-b-0" data-role="tasklist">
                                <li class="list-group-item" data-role="task">
                                    @foreach ($todo as $todoList)
                                    <div class="checkbox checkbox-info" style="font-size: medium">
                                        <i class="mdi mdi-arrow-right-bold-circle-outline"></i>
                                        <label for="inputSchedule" class=""><span>{{$todoList->todo}}</span> </label>
                                    </div>
                                    @endforeach
                                </li>
                                <a href="{{url('delete-todo')}}" style="color: red">
                                    <i class="mdi mdi-delete-circle"></i> Delete all todo
                                </a>
                            </ul>
                        </div>
                        {{$todo->appends(['todo' => $news->currentPage()])->links()}}
                    </div>
                </div>
                <div class="card" style="bottom: 15px">
                    <div class="card-body">
                        <h4 class="card-title"><i class="mdi mdi-cake"></i> Today's Birth</h4>
                        <h6 class="card-subtitle">Say birthday to your friends</h6>
                        <div class="little-profile">
                            @if(count($birth_now) < 1) Birthday's , Not Available @else @foreach($birth_now as $bn)
                                @if($bn->profile_picture == null)
                                <div class="mytooltip">
                                    <img href="javascript:void(0)" style="width: 20%;border-radius: 50%"
                                        src="{{asset('images/user.png')}}" lt="user">
                                    <span class="tooltip-content3">Hello I'm {{ $bn->name }}. Say happy birthday to me !
                                    </span>
                                </div>
                                @else
                                <div class="mytooltip">
                                    <img href="javascript:void(0)" style="width: 20%;border-radius: 50%"
                                        src="{{asset('images/profile/'.$bn->profile_picture)}}" lt="user"
                                        data-toggle="tooltip">
                                    <span class="tooltip-content3">Hello I'm {{ $bn->name  }}. Say happy birthday to me
                                        !
                                    </span>
                                </div>
                                @endif
                                @endforeach
                                @endif
                        </div>
                    </div>
                </div>
                {{-- modal absen --}}
                <div class="modal fade" id="myAbsen" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><i class="mdi mdi-clock-alert"></i> Attendance</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span> </button>
                            </div>
                            <div class="modal-body" style="text-align: center">
                                <form action="{{ url('do_absen') }}" class="form-horizontal form-submit" method="post"
                                    enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    @if(!isset($cek_absen->check_in))
                                    <button type="submit" name="btnIn" value="check_in"
                                        class="btn btn-success submit-btn">check in</button>
                                    <button type="submit" name="btnOut" value="check_out"
                                        class="btn btn-success submit-btn" disabled>check out</button>
                                    @elseif(!isset($cek_absen->check_out))
                                    <button type="submit" name="btnIn" value="check_in"
                                        class="btn btn-success submit-btn" disabled>check in</button>
                                    <button type="submit" name="btnOut" value="check_out"
                                        class="btn btn-success submit-btn">check out</button>
                                    @else
                                    <h3>Absen Hari ini selesai !</h3>
                                    <button type="submit" name="btnIn" value="check_in"
                                        class="btn btn-success submit-btn" disabled>check in</button>
                                    <button type="submit" name="btnOut" value="check_out"
                                        class="btn btn-success submit-btn" disabled>check out</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end modal --}}
            </div>
        </div>
        </div>
    </body>
</section>
@endsection