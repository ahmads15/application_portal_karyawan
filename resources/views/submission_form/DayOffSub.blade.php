@extends('layouts.app')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Day Off Submission 
    <small>Add New Submission</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a></i>Submission Form</a></li>
    <li class="active">Day Off Submission</li>
  </ol>
</section>
@include('sweet::alert')
<!-- Main content -->
<section class="content">
  <br>
  <br>
  <div class="row">  
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Submission</h3>
        </div>                
      
        <form action="{{url('SubmissionForm-DayOffSubmission')}}"  method="POST" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="box-body">
            
            {{-- supervisor berdasarkan divisi --}}
            <div class="form-group" >
                <label for="">Supervisor</label>
                <!-- <input type="text" name="shelf" class="form-control" placeholder="Shelf"> -->
                <select class="form-control" style="width: 100%;"  name="user_id">
                    <option value="" selected disabled>-- Select Supervisor --</option>
                    @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name_spv}}</option>
                    @endforeach
                </select>
            </div>
            
            {{-- Jenis Cuti --}}
            <div class="form-group" >
                <label for="">Leave Type</label>
                <!-- <input type="text" name="shelf" class="form-control" placeholder="Shelf"> -->
                <select class="form-control" style="width: 100%;"  name="leave_type_id">
                    <option value="" selected disabled>-- Select Leave Type --</option>
                    @foreach($leave_type as $leave)
                    <option value="{{$leave->id}}">{{$leave->name_leave}}</option>
                    @endforeach
                </select>
            </div>
            
            {{-- Lama cuti (AUTO GENERATE BASED ON START & END DATE)--}}
            <div class="form-group">
              <label>Day Off Duration</label>
              <input type="" name="day_amount_sub" class="form-control" id="" placeholder="Duration(Day)">
            </div>
            {{-- Alasan cuti --}}
            <div class="form-group">
              <label>Day Off Reason</label>
              <textarea class="form-control" placeholder="Reason" name="reason" id="" rows="3"></textarea>
            </div>
            
            <!-- Start Date -->
            <div class="form-group">
              <label>Start Date:</label>
              
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="date" class="form-control pull-right" id="datepicker" name="start_date">
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->
            
            <!-- End Date -->
            <div class="form-group">
              <label> End Date:</label>
              
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="date" class="form-control pull-right" id="datepicker2" name="end_date">
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->
            
            {{-- button submit --}}
            <button class="btn btn-primary" type="submit">SUBMIT</button>
            
          </div>
          <!-- /.box-body -->
        </form>
        {{-- form --}}
      </div>
    </div>
    <div class="col-md-3"></div>
  </div>
</section>
@endsection
