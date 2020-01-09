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
                            <h3 class="text-themecolor">Incentive Master </h3>
                        </div>
                        <div class="col-md-12 col-8 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Incentive Level Master </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- .modal for add salary -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-plus"></i> Add New Incentive Level</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span> </button>
                    </div>
                    <div class="modal-body">
                            <form role="form" action="/masterdata-payrollmaster-incentivemaster-store" method="post">
                                {{csrf_field()}}
                            <div class="form-group">
                                <label style="font-size: medium">Incentive Name<b style="color: red">*</b></label>
                                <input type="text" class="form-control" name="incentive_name" required>
                            </div>
                            <div class="form-group">
                                <label style="font-size: medium">Salary<b style="color: red">*</b></label>
                                <input type="text" class="form-control" name="salary" id="rupiah" required>
                            </div>
                            <div class="form-group">
                                <label style="font-size: medium">Year<b style="color: red">*</b></label>
                                <input type="number" class="form-control" name="year" required>
                            </div>
                            <P>[<b style="color: red">*</b>]<b> Mendatory Data</b></P>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <button type="submit" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal -->
        <!-- .modal for edit salary -->
        @foreach ($incentive as $i)
        <div class="modal fade" id="myModalEdit-{{$i->id}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Incentive </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span> </button>
                    </div>
                    <div class="modal-body">
                            <form role="form" action="{{ url('/masterdata-payrollmaster-incentivemaster-edit/'.$i->id) }}"
                                method="post">
                                {{csrf_field()}} 
                            <div class="form-group">
                                <label style="font-size: medium">Incentive Name<b style="color: red">*</b></label>
                                <input type="text" class="form-control" name="incentive_name" value="{{$i->incentive_name}}" required>
                            </div>
                            <div class="form-group">
                                <label style="font-size: medium">Salary<b style="color: red">*</b></label>
                                <input type="text" class="form-control" name="salary" value="{{$i->salary_amount}}"  id="rupiah" required >
                            </div>
                            <div class="form-group">
                                <label style="font-size: medium">Year<b style="color: red">*</b></label>
                                <input type="number" class="form-control" name="year" value="{{$i->year}}" required>
                            </div>
                            <P>[<b style="color: red">*</b>]<b> Mendatory Data</b></P>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Save</button>
                                <button type="submit" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <!-- /.modal -->
        <div class="card">
            <div class="card-body">
                <div>
                    <a style="color: white" data-toggle="modal" data-target="#myModal"
                        class="float-right btn-sm btn-default btn-success"> <i class="fa fa-plus-circle"></i> Add New
                        Incentive
                    </a>
                </div>
                <h4 class="card-title">Incentive Master</h4>
                <h6 class="card-subtitle">View Data Incentive </h6>
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
                                <th>Incentive Name</th>
                                <th>Salary</th>
                                <th>Year</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0?>
                            @foreach ($incentive as $i)
                            <?php $no++?>
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{ $i->incentive_name }}</td>
                                <td>{{ $i->salary_amount}}</td>
                                <td>{{ $i->year}}</td>
                                <td>
                                    <span data-toggle="tooltip" data-target="#id" title="Edit">
                                        <a href="#myModalEdit-{{$i->id}}" data-toggle="modal"><i
                                                class="fa fa-edit"></i></a>
                                    </span>
                                    <a href="{{url('/masterdata-payrollmaster-incentivemaster-delete/'.$i->id)}}"
                                        data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
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

    <script type="text/javascript">
        var rupiah = document.getElementById('rupiah');
    rupiah.addEventListener('keyup', function(e){
        rupiah.value = formatRupiah(this.value, 'Rp. ');
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
    </script>

    @endsection