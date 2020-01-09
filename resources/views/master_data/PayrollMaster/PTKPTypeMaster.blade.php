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
                            <h3 class="text-themecolor">PTKP Type Master </h3>
                        </div>
                        <div class="col-md-12 col-8 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">PTKP Type Master </li>
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
                        <h4 class="modal-title"><i class="fa fa-plus"></i> Add New PTKP Type</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span> </button>
                    </div>
                    <div class="modal-body">
                        <form role="form" action="/masterdata-payrollmaster-PTKPtypemaster-store" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label style="font-size: medium">PTKP Type<b style="color: red">*</b></label>
                                <input type="text" class="form-control" name="jenis_ptkp" required>
                            </div>
                            <div class="form-group">
                                <label style="font-size: medium">Nominal PTKP<b style="color: red">*</b></label>
                                <input type="text" class="form-control" name="nominal_ptkp" id="rupiah" required>
                            </div>
                            <div class="form-group">
                                <label style="font-size: medium">Number of children<b style="color: red">*</b></label>
                                <input type="number" class="form-control" name="jumlah_anak" required>
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
        @foreach ($ptkp as $p)
        <div class="modal fade" id="myModalEdit-{{$p->id}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit PTKP Type</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span> </button>
                    </div>
                    <div class="modal-body">
                        <form role="form" action="{{ url('/masterdata-payrollmaster-PTKPtypemaster-edit/'.$p->id) }}"
                            method="post">
                            {{csrf_field()}}  
                            <div class="form-group">
                                <label style="font-size: medium">PTKP Type<b style="color: red">*</b></label>
                                <input type="text" class="form-control" name="jenis_ptkp" value="{{$p->jenis_ptkp}}" required>
                            </div>
                            <div class="form-group">
                                <label style="font-size: medium">Nominal<b style="color: red">*</b></label>
                                <input type="text" class="form-control" name="nominal_ptkp" value="{{$p->nominal_ptkp}}"  id="rupiah" required >
                            </div>
                            <div class="form-group">
                                    <label style="font-size: medium">Nominal of children<b style="color: red">*</b></label>
                                    <input type="number" class="form-control" name="jumlah_anak" value="{{$p->jumlah_anak}}" required>
                            </div>
                            <div class="form-group">
                                <label style="font-size: medium">Year<b style="color: red">*</b></label>
                                <input type="number" class="form-control" name="year" value="{{$p->year}}" required>
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
                        PTKP Type
                    </a>
                </div>
                <h4 class="card-title">PTKP Type</h4>
                <h6 class="card-subtitle">View Data PTKP Type</h6>
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
                                <th>PTKP Type</th>
                                <th>Nominal</th>
                                <th>Nominal of children</th>
                                <th>Year</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0?>
                            @foreach ($ptkp as $p)
                            <?php $no++?>
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{ $p->jenis_ptkp }}</td>
                                <td>{{ $p->nominal_ptkp}}</td>
                                <td>{{ $p->jumlah_anak}}</td>
                                <td>{{ $p->year}}</td>
                                <td>
                                    <span data-toggle="tooltip" data-target="#id" title="Edit">
                                        <a href="#myModalEdit-{{$p->id}}" data-toggle="modal"><i
                                                class="fa fa-edit"></i></a>
                                    </span>
                                    <a href="{{ url('/masterdata-payrollmaster-PTKPtypemaster-delete/'.$p->id) }}"
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