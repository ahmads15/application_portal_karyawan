@extends('layouts.app-spinner')
@section('content')

<section class="content">
    @include('layouts.partials.alerts')

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
                            <h3 class="text-themecolor"> Employee Detail Master</h3>
                        </div>
                        <div class="col-md-12 col-8 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item">Employee Master By HRD</li>
                                <li class="breadcrumb-item active">Employee Detail</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline-info">
                    <div class="card-body">
                        <form action="" class="" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-body">
                                @if ($errors->any())
                                <div class="form-group">
                                    <div class="alert alert-danger">
                                        {{ $errors->first() }}
                                    </div>
                                </div>
                                @endif
                                @include('layouts.partials.alerts')
                                <h3 class="card-title">Personal Info</h3>
                                <hr>
                                <div class="row p-t-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"> Name<b style="color:red">*</b></label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{$users->name}}">
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Bank <b style="color:red">*</b></label>
                                            <select class="form-control" name="bank">
                                                <option value="" selected disabled>-- Select Bank --</option>
                                                @foreach($bank as $b)
                                                <option value="{{$b->id}}"
                                                    {{$b->id == $users->bank_id ? 'selected' : ''}}> {{$b->bank_code}} -
                                                    {{$b->bank_name}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Employee ID<b style="color:red">*</b></label>
                                        <input type="number" name="nip" class="form-control" value="{{$users->nip}}">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">No Rekening<b style="color:red">*</b></label>
                                        <input type="number" name="no_rekening" class="form-control"
                                            value="{{$users->no_rekening}}">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Region<b style="color:red">*</b></label>
                                        <input type="text" name="region" class="form-control"
                                            value="{{$users->region}}">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Marital Status<b style="color:red">*</b></label>
                                        <input type="text" name="status" class="form-control"
                                            value="{{$users->status}}">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Gender<b style="color:red">*</b></label>
                                        <div class="m-b-10">
                                            <label class="custom-control custom-radio">
                                                <input id="radio5" type="radio" class="custom-control-input"
                                                    name="gender" value="Male"
                                                    {{ ($users->gender == 'Male') ? 'checked' : '' }}>
                                                <span class="custom-control-label">Male</span>
                                            </label>
                                            <label class="custom-control custom-radio">
                                                <input id="radio6" class="custom-control-input" type="radio"
                                                    name="gender" value="{{$users->gender}}"
                                                    {{ ($users->gender == 'Female') ? 'checked' : '' }}>
                                                <span class="custom-control-label">Female</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Last Education<b style="color:red">*</b></label>
                                        <input type="text" name="education" class="form-control"
                                            value="{{$users->education}}">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Date of Birth<b style="color:red">*</b></label>
                                        <input type="date" name="birthofdate" class="form-control"
                                            value="{{$users->birthofdate}}">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Place of Birth<b style="color:red">*</b></label>
                                        <input type="text" name="placeofbirth" class="form-control"
                                            value="{{$users->placeofbirth}}">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Number of Kids<b style="color:red">*</b></label>
                                        <input type="number" name="number_of_kids" class="form-control"
                                            value="{{$users->number_of_kids}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Address<b style="color:red">*</b></label>
                                        <textarea name="address" class="form-control" cols="30"
                                            rows="10">{{$users->address}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <h3 class="box-title m-t-40">Company Info</h3>
                            <hr>
                            <div class="row">                    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Division<b style="color:red">*</b></label>
                                        <select class="form-control" name="division">
                                            <option value="">-Select division-</option>
                                            @foreach ($divisions as $dv)
                                            <option {{$dv->id == $dv->division_id ? 'selected' : ''}} value="{{$dv->id}}">
                                                {{$dv->division_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Department<b style="color:red">*</b></label>
                                        <select class="form-control" name="department" id="department">
                                            <option value="" selected disabled>-- Select Department --</option>
                                            @foreach($department as $d)
                                            <option value="{{$d->id}}"
                                                {{$d->id == $users->department_id ? 'selected' : ''}}>
                                                {{$d->department_name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Head Supervisor</label>
                                        <input type="text" name="head_supervisor" class="form-control" disabled
                                            placeholder="Head Supervisor">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Supervisor</label>
                                        <input type="text" name="supervisor" class="form-control" disabled
                                            placeholder="Supervisor">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Position<b style="color:red">*</b></label>
                                        <select class="form-control" name="position">
                                            <option value="" selected disabled>-- Select Position --</option>
                                            @foreach($position as $p)
                                            <option value="{{$p->id}}"
                                                {{$p->id == $users->position_id ? 'selected' : ''}}>
                                                {{$p->position_name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--/span-->
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Employee Status<b style="color:red">*</b></label>
                                        {{-- <input type="text" name="status_karyawan" class="form-control"
                                                        value="{{$users->status_karyawan}}"> --}}
                                        <select class="form-control" name="status_karyawan">
                                            <option value="" selected disabled>-- Select Employee Status --</option>
                                            <option value="tetap">Tetap</option>
                                            <option value="kontrak">Kontrak</option>
                                            <option value="internship">Internship</option>
                                        </select>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Leave Amount<b style="color:red">*</b></label>
                                        <input type="number" name="default_leave" class="form-control"
                                            value="{{$users->default_leave}}">
                                    </div>
                                </div>
                            </div>

                            <h3 class="box-title m-t-40">Contact Info</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Emergency Name<b style="color:red">*</b></label>
                                        <input type="text" name="emergency_name" class="form-control"
                                            value="{{$users->emergency_name}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Emergency Number<b style="color:red">*</b></label>
                                        <input type="number" name="emergency_number" class="form-control"
                                            value="{{$users->emergency_number}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Company Email<b style="color:red">*</b></label>
                                        <input type="email" name="email" class="form-control" value="{{$users->email}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Private Email<b style="color:red">*</b></label>
                                        <input type="email" name="private_email" class="form-control"
                                            value="{{$users->private_email}}">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Private Number<b style="color:red">*</b></label>
                                        <input type="number" name="phone_number" class="form-control"
                                            value="{{$users->phone_number}}">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div>
                                <h5><b>Notes :</b></h5>
                                <h6>[<b style="color: red">*</b>] Mendatory Data </h6>
                            </div>
                            <br>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"> Save</button>
                                <a href="{{url('master-employee-detail')}}">
                                    <button type="button" class="btn btn-inverse">Cancel</button>
                                </a>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </body>
</section>

<script>
    $(function () {
        var id = 0;

        var division = $('select[name=division]');
        var department = $('select[name=department]');
        var supervisor = $('input[name=supervisor]');
        var head_supervisor = $('input[name=head_supervisor]');
        var position = $('select[name=position]');

        division.change(function(){
            id = $(this).val();

            $.ajax({
                url : '{{url('find-department')}}',
                method : 'GET',
                data : {
                    id : id,
                },
                success: function (data) {
                  var option = '<option value="">--Select Department --</option>'
                  
                  for(var i = 0 ; i < data.length ; i++){
                      option += '<option value="'+data[i].id+'">'+data[i].department_name+'</option>'
                  }
                  department.html(option);
                },
            })
        });

        department.change(function(){
            id = $(this).val();

            $.ajax({
                url : '{{url('find-supervisor')}}',
                method : 'GET',
                data : {
                    id : id,
                },
                success: function (data) {
                    supervisor.val(data.supervisor);
                    head_supervisor.val(data.head_supervisor);
                },
            })

            $.ajax({
                url : '{{url('find-position')}}',
                method : 'GET',
                data : {
                    id : id,
                },
                success: function (data) {
                    var option = '<option value="">-- Select Position --</option>'
                  
                    for(var i = 0 ; i < data.length ; i++){
                        option += '<option value="'+data[i].id+'">'+data[i].position_name+'</option>'
                    }
                    position.html(option);
                },
            })
        })
    });
</script>
@endsection