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
                            <h3 class="text-themecolor">Employee Submit Payroll</h3>
                        </div>
                        <div class="col-md-12 col-8 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item">Employee Report</li>
                                <li class="breadcrumb-item">Employee Payroll</li>
                                <li class="breadcrumb-item active">Employee Submit Payroll</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- main content --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white">Payroll form - {{\Carbon\Carbon::now()->format('M Y')}}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{url('submit-salary-payroll')}}" class="form-horizontal" method="POST">
                            {{csrf_field()}}
                            <div class="form-body">
                                <h3 class="box-title">Person Info</h3>
                                <hr class="m-t-0 m-b-40">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Employee ID</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="1901516463"
                                                    readonly value="{{$data_user->nip}}">
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Marital Status</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Married" readonly
                                                    value="{{$data_user->status}}">
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Name</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="John doe" readonly
                                                    value="{{$data_user->name}}">
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Number of kid</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="" readonly
                                                    value="{{$data_user->number_of_kids}}">
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Gender</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Male" readonly
                                                    value="{{$data_user->gender}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Division</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Division 1"
                                                    readonly value="{{$data_user->division_name}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Date of Birth</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="22 Juni 1997"
                                                    readonly value="{{$data_user->birthofdate}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Department</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Department 1"
                                                    readonly value="{{$data_user->department_name}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Address</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Jl. Gading Raya"
                                                    readonly value="{{$data_user->address}}">
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Position</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Position 1"
                                                    readonly value="{{$data_user->position_name}}">
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Employee Status</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" readonly
                                                    value="{{$data_user->status_karyawan}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Bank</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" readonly
                                                    value="{{$data_user->bank_name}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="box-title">Salary Detail</h3>
                                <hr class="m-t-0 m-b-40">
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Salary Level</label>
                                            <div class="col-md-9">
                                                <select class="form-control custom-select" id="salary-level"
                                                    name="salary_level" data-placeholder="Choose a Category"
                                                    tabindex="1" onchange="changeBaseAmount(this)">
                                                    @foreach($data_salary as $data)
                                                        @if($data->id == $salary_level_id)
                                                        <option value="{{$data->id}}"
                                                            data-salary-amount="{{$data->salary_amount}}" selected>
                                                            {{$data->salary_level_name}}</option>
                                                        @else
                                                        <option value="{{$data->id}}"
                                                            data-salary-amount="{{$data->salary_amount}}">
                                                            {{$data->salary_level_name}}</option>
                                                        @endif
                                                        
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Based Salary</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="based-salary" name="basedsalary"
                                                    placeholder="Based Salary" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="m-t-0 m-b-40">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="box-title" style="text-align: center">Additional Fee</h3>
                                    </div>
                                </div>
                                <br><br>
                                <div id="education_fields">
                                    <?php $i = 0?>
                                    @foreach ($arr_salary as $as)
                                    <?php $i++?>
                                    <div class="form-group removeclass{{$i}}">
                                        <div class="row">
                                            <div class="col-sm-3 nopadding">
                                                <div class="form-group"><input type="text" class="form-control"
                                                        id="Schoolname" name="Schoolname[]"
                                                        value="{{$as->salary_component}}" placeholder="Component Name">
                                                </div>
                                            </div>
                                            <div class="col-sm-3 nopadding">
                                                <div class="form-group">
                                                    <div class="input-group"> <input type="number" class="form-control"
                                                            id="Major" name="Major[]" placeholder="IDR"
                                                            value="{{$as->salary_amount}}">
                                                        <div class="input-group-append"> <button class="btn btn-danger"
                                                                type="button"
                                                                onclick="remove_education_fields({{$i}});"> <i
                                                                    class="fa fa-minus"></i> </button></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 nopadding">
                                        <button class="btn btn-success" type="button"
                                            onclick="education_fields({{$i}});"><i class="fa fa-plus"></i></button>
                                    </div>
                                    {{--DUMMY--}}
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Overtime Hours</label>
                                            <div class="col-md-9">
                                                <input id="total-overtime" type="text" class="form-control"
                                                    name="total_hours" readonly placeholder="00:00">
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">IDR/Hours</label>
                                            <div class="col-md-9">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="IDR/Hours"
                                                        name="overtime_hours" value="{{$overtime_hours}}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text text-success" id="basic-addon2"><i
                                                                class="{{($overtime_hours ? 'fas fa-check-circle' : 'd-none')}}"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <hr class="m-t-0 m-b-40">
                                <div class="row">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Total Salary</label>
                                            <div class="col-md-9">
                                                <input id="total-salary" type="text" class="form-control"
                                                    placeholder="Total Salary" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                            </div>
                            <hr>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <input type="hidden" name="id" value="{{$id}}">
                                                <button type="submit" class="btn btn-success">Submit</button>
                                                <a href="{{url('EmployeePayroll')}}">
                                                    <button id="cancel" type="button"
                                                        class="btn btn-inverse">Cancel</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6"> </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="../plugins/dff/dff.js" type="text/javascript"></script>
    <script>
        var overtimes = <?php echo $overtimes; ?>;

        var based_salary = 0;
        var add_salary = 0;
        var over_salary = 0;

        var total_salary = 0;

        var overtime = 0;

        $(function () {
            var amount_list = $('input[name="Major[]"]').map(function() {
                    return $(this).val();
                }).get();

            for(var i = 0 ; i < amount_list.length ; i++){
                add_salary += parseFloat(amount_list[i]);
            }

            overtime = $('#total-overtime').val();
            over_salary = parseFloat(overtime.substr(0,2))*parseFloat($('input[name="overtime_hours"]').val());

            total_salary = based_salary + add_salary + over_salary;
            $('#total-salary').val(total_salary);

            // Overtime
            var total_overtime = '00:00';
            for(var i = 0 ; i < overtimes.length ; i++){
                total_overtime = timeAdd(total_overtime, overtimes[i].hours)
            }

            $('#total-overtime').val(total_overtime);

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

            $('#cancel').click(function(){
                var comp_list = $('input[name="Schoolname[]"]').map(function() {
                    return $(this).val();
                }).get();

                var amount_list = $('input[name="Major[]"]').map(function() {
                    return $(this).val();
                }).get();

                console.log(comp_list);
                console.log(amount_list);
            });
            
            $('#EmployeeData').DataTable();
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
        $(document).ready(function () {
            $('#salary-level').trigger('change');
            var cleave = new Cleave($('#based-salary'), {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            total = 0;
            $("input[name='Major[]']").map(function(){
                $(this).on('keyup', function () {
                    total += this.value;
                })
            });
        });
        function changeBaseAmount(e) {
            var value = $(e).val();
            var amount = $(e).find('option[value="'+value+'"]').data('salary-amount');

            based_salary = parseFloat(amount.replace(/[.]/g, ''));

            overtime = $('#total-overtime').val();
            over_salary = parseFloat(overtime.substr(0,2))*parseFloat($('input[name="overtime_hours"]').val());

            total_salary = based_salary + add_salary + over_salary;
            $('#total-salary').val(total_salary);

            $('#based-salary').val(amount);
        }
    </script>


</section>
@endsection