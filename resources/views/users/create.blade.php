@extends('layouts.app')
@section('content')
<section class="content-header">

  <h1>
    Add User
    <small>Add New User</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#"><i class="fa fa-users"></i> Manage User</a></li>
    <li class="active">Create User</li>
  </ol>
</section>
@include('layouts.partials.alerts')

<div class="content">
  <div class="row">
    <div class="col-lg-6">
      {{ Form::open(array('url' => 'users')) }}
      @if ($errors->any())
      <div class="form-group">
        <div class="alert alert-danger col-md-12">
          {{ $errors->first() }}
        </div>
      </div>
      @endif

      <br><br>
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">General Info</h3>
        </div>
        <div class="box-body">
          <!-- Date dd/mm/yyyy -->
          <div class="form-group">
            <div class="form-group">
              <label>NIP (Nomer Induk Pegawai)<b style="color:red">*</b>  :</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-id-card"></i>
                </div>
                <input type="number"  name="nip" class="form-control" >
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>Name <b style="color:red">*</b> :</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-user-o"></i>
              </div>
              <input type="text"  name="name" class="form-control">
            </div>
          </div>

          <div class="form-group">
            <label>Region <b style="color:red">*</b> :</label>
            <div class="input-group">
              <div class="input-group-addon">
                  <i class="fas fa-praying-hands"></i>
              </div>
              <input type="text" name="region" class="form-control">
            </div>
          </div>

          <div class="form-group" style="margin: 20px;">

            <label for="">Gender <b style="color:red">*</b> </label>

            <div>
              <label for="gender-m" style="margin-right: 20px; font-weight: 100">
                <input id="gender-m" type="radio" name="gender" value="Male" {{ (old('gender') == 'Male') ? 'checked' : '' }}> Male
              </label>

              <label for="gender-f" style="font-weight: 100">
                <input id="gender-f" type="radio" name="gender" value="Female" {{ (old('gender') == 'Female') ? 'checked' : '' }}> Female
              </label>
            </div>
          </div>

          <div class="form-group">
            <label>Education <b style="color:red">*</b>:</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-graduation-cap"></i>
              </div>
              <input type="text"  name="education" class="form-control">
            </div>
          </div>



          <div class="form-group">
            <label>Place of birth <b style="color:red">*</b>:</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fas fa-home"></i>
              </div>
              <input type="text"  name="placeofbirth" class="form-control">
            </div>
          </div>

          <div class="form-group">
            <label>Birth of Date <b style="color:red">*</b>:</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="date"  name="birthofdate" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask>
            </div>
          </div>
          <div class="form-group">
            <label>Address<b style="color:red">*</b>:</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-map-marker"></i>
              </div>
              <textarea name="address" class="form-control" cols="30" rows="10"></textarea>
            </div>
          </div>

          <div class="form-group">
            <label>Status Perkawinan <b style="color:red">*</b>:</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-check"></i>
              </div>
              <input type="text"  name="status" class="form-control">
            </div>
          </div>


          <!-- /.form group -->

        </div>
        <!-- /.box-body -->
      </div>
    </div>


    {{-- Company Info --}}
    <br><br>
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Company Info</h3>
        </div>
        <div class="box-body">
          <!-- Date -->

          <div class="form-group">
            <label for="">Department <b style="color:red">*</b>:</label>
            <!-- <input type="text" name="category" class="form-control" placeholder="Category"> -->
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-building-o"></i>
              </div>
              <select class="form-control" name="department">
                <option value="" selected disabled>-- Select Department --</option>
                @foreach($department as $d)
                  <option value="{{$d->id}}">{{$d->name}}</option>

                  @endforeach
                </select>
              </div>
            </div>

          <div class="form-group">
            <label for="">Division <b style="color:red">*</b>:</label>
            <!-- <input type="text" name="category" class="form-control" placeholder="Category"> -->
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-building-o"></i>
              </div>
              <select class="form-control" name="division">
                <option value="" selected disabled>-- Select Division --</option>
                @foreach($division as $dv)
                  <option value="{{$dv->id}}">{{$dv->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="">Position <b style="color:red">*</b>:</label>
              <!-- <input type="text" name="category" class="form-control" placeholder="Category"> -->
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-building-o"></i>
                </div>
                <select class="form-control" name="position">
                  <option value="" selected disabled>-- Select Position --</option>
                  @foreach($position as $p)
                    <option value="{{$p->id}}">{{$p->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label for="">PTKP (Penghasilan Tidak Kena Pajak) <b style="color:red">*</b>:</label>
                <!-- <input type="text" name="category" class="form-control" placeholder="Category"> -->
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-building-o"></i>
                  </div>
                  <select class="form-control" name="ptkp">
                    <option value="" selected disabled>-- Select PTKP --</option>
                    {{-- @foreach($division as $dv)
                      <option value="{{$dv->id}}">{{$dv->name}}</option>
                      @endforeach --}}
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label>Status Karyawan<b style="color:red">*</b>:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-check"></i>
                    </div>
                    <input type="text"  name="status_karyawan" class="form-control">
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>


          {{-- Contact Info  --}}
          <div class="col-md-6">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">Contact Info</h3>
              </div>
              <div class="box-body">
                <!-- Date -->

                <div class="form-group">
                  <label>Private Email:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-envelope-o"></i>
                    </div>
                    <input type="email" name="private_email" class="form-control">
                  </div>
                </div>

                <div class="form-group">
                  <label>Company Email<b style="color:red">*</b>:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-envelope-o"></i>
                    </div>
                    <input type="email" name="email" class="form-control">
                  </div>
                </div>

                <div class="form-group">
                  <div class="form-group">
                    <label>Phone Number <b style="color:red">*</b>:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-id-card"></i>
                      </div>
                      <input type="number"  name="phone_number" class="form-control" >
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="form-group">
                    <label>Emergency Number:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-id-card"></i>
                      </div>
                      <input type="number"  name="emergency_number" class="form-control" >
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="form-group">
                    <label>Emergency Name:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-id-card"></i>
                      </div>
                      <input type="text"  name="emergency_name" class="form-control" >
                    </div>
                  </div>
                </div>

                <div class='form-group'>
                  {{ Form::label('Roles') }}
                  <br> @foreach ($roles as $role) {{ Form::checkbox('roles[]', $role->id ) }} {{ Form::label($role->name, ucfirst($role->name))
                  }}
                  <br> @endforeach
                </div>
                {{--  --}}
                {{ Form::submit('Add', array('class' => 'btn btn-primary')) }} {{ Form::close() }}

              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>

        </div>
      </div>
      @endsection