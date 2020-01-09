@extends('layouts.app') 
@section('content')


<section class="content-header">
    
    @can('Approval')
    <h1>
        Approval
        
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('Dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Approval</li>
    </ol>
</section>

<br>
@include('sweet::alert')
<body>
    <br><br><br>
    @if ($errors->any())
    <div class="form-group">
        <div class="alert alert-danger col-md-12">
            {{ $errors->first() }}
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-md-8 col-md-offset-2" >
            <form action="{{url('department-search')}}" method="POST">
                {{csrf_field()}}
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by Name">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-secondary">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
    <br>
    <div class="row">
        @if(isset($search))
        <div class="col-md-8 col-md-offset-2" >
            <br>
            <p>Your Search Result with '<b>{{$search}}</b>' Keyword(s)</p>
        </div>
        @endif
    </div>
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2" style="bottom: 30px">
            
            <br><br> 
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Data Approval</h3>         
                </div>
                <table  class="table table-bordered table-striped" >
                    <thead>
                        <tr>
                            <th><b style="left:20px;position: relative">No</b></th>
                            <th ><b style="left: 20px;position: relative">Date</b></th>     
                            <th ><b style="left: 20px;position: relative">Nama Pemohon</b></th>   
                            <th ><b style="left: 20px;position: relative">Nama Penerima</b></th>   
                            <th ><b style="left: 20px;position: relative">Type Approval</b></th>   
                            <th ><b style="left: 20px;position: relative">Status</b></th> 
                            <th><b style="left: 20px;position: relative">Operation</b></th>             
                        </tr>
                    </thead>
                    <tbody>
                    </tfoot>
                    
                    <tr>
                        <td><b style="left:25px;position: relative">1</b></td>
                        <td ><b style="left: 20px;position: relative">27-04-2019</b></td>
                        <td ><b style="left: 20px;position: relative">Rifqi Ernaldi</b></td>
                        <td ><b style="left: 20px;position: relative">Halim Cakra W</b></td>
                        <td ><b style="left: 20px;position: relative">Pengajuan Cuti</b></td>
                        <td>
                            <span style="left: 20px;position: relative" class="label label-warning">Waiting</span>
                        </td>
                        <td>
                            <div class="tools">
                                
                                {{-- <a href="#" onclick="departmentFormEdit()" data-toggle="tooltip" title="Edit" style="margin-right:5px;"><i class="fa fa-edit"></i></a> --}}
                                <span  style="left: 20px;position: relative" data-toggle="tooltip" data-target="#id" title="">
                                    <a href="#modal-departmentEdit1" data-toggle="modal" style="margin-right:5px;"><i class="fa fa-eye"></i> Detail</a>
                                </span>
                            </div>
                        </td>
                    </tr> 
                    <tr>
                        <td><b style="left:25px;position: relative">2</b></td>
                        <td ><b style="left: 20px;position: relative">27-04-2019</b></td>
                        <td ><b style="left: 20px;position: relative">Aji</b></td>
                        <td ><b style="left: 20px;position: relative">Halim Cakra W</b></td>
                        <td ><b style="left: 20px;position: relative">Pengajuan Lembur</b></td>
                        <td>
                            <span style="left: 20px;position: relative" class="label label-warning">Waiting</span>
                        </td>
                        <td>
                            <div class="tools">
                                
                                {{-- <a href="#" onclick="departmentFormEdit()" data-toggle="tooltip" title="Edit" style="margin-right:5px;"><i class="fa fa-edit"></i></a> --}}
                                <span  style="left: 20px;position: relative" data-toggle="tooltip" data-target="#id" title="">
                                    <a href="#modal-departmentEdit" data-toggle="modal" style="margin-right:5px;"><i class="fa fa-eye"></i> Detail</a>
                                </span>
                            </div>
                        </td>
                    </tr> 
                    <tr>
                        <td><b style="left:25px;position: relative">3</b></td>
                        <td ><b style="left: 20px;position: relative">27-04-2019</b></td>
                        <td ><b style="left: 20px;position: relative">Carol Danvers</b></td>
                        <td ><b style="left: 20px;position: relative">Halim Cakra W</b></td>
                        <td ><b style="left: 20px;position: relative">Pengajuan Lembur</b></td>
                        <td>
                            <span style="left: 20px;position: relative" class="label label-success">Approved</span>
                        </td>
                        <td>
                            <div class="tools">
                                
                                {{-- <a href="#" onclick="departmentFormEdit()" data-toggle="tooltip" title="Edit" style="margin-right:5px;"><i class="fa fa-edit"></i></a> --}}
                                <span  style="left: 20px;position: relative" data-toggle="tooltip" data-target="#id" title="">
                                    <a href="#modal-departmentEdit2" data-toggle="modal" style="margin-right:5px;"><i class="fa fa-eye"></i> Detail</a>
                                </span>
                            </div>
                        </td>
                    </tr> 
                    {{-- asdasd --}}
                    <div class="modal fade" id="modal-departmentEdit1" tabindex="-1" role="dialog" aria-labelledby="modal-departmentEdit1" aria-hidden="true">
                        <div class="modal-dialog" style="">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h3 class="modal-title" id="modal-departmentEdit1"><b style="color: #367fa9;text-align: center;position: relative">Days Off Submission</b></h3>
                                </div>    
                                <div class="modal-body" >
                                    <form action="#" class="form-horizontal" method="POST" enctype="multipart/form-data">
                                        {{csrf_field()}}  
                                        <div class="modal-body">
                                            <div class="form-group" style="margin: 20px">
                                                <label for="" class="col-md-3 control-label">Supervisor : </label>
                                                <input type="text" name="name" class="form-control"  value="Halim Cakra W">      
                                            </div>        
                                            
                                            <div class="form-group"  style="margin: 20px">
                                                <label for="" class="col-md-3 control-label">Days Off Type : </label>                                             
                                                <input type="text" name="name" class="form-control"  value="Cuti liburan">
                                            </div>        
                                            
                                            <div class="form-group" style="margin: 20px">
                                                <label for="" class="col-md-6 control-label">Days Off Duration : </label>
                                                
                                                <input type="text" name="name" class="form-control"  value="7 Days">
                                                
                                                
                                            </div>  
                                            <div class="form-group" style="margin: 20px">
                                                <label for="" class="col-md-6 control-label">Days Off Reason : </label>
                                                
                                                <input type="text" name="name" class="form-control"  value="Pulang Kampung bareng keluarga">
                                                
                                            </div>    
                                            <div class="form-group" style="margin: 20px">
                                                <label for="" class="col-md-3 control-label">Start Date : </label>
                                                
                                                <input type="text" name="name" class="form-control"  value="01-05-2019">
                                                
                                            </div>  
                                            <div class="form-group" style="margin: 20px">
                                                <label for="" class="col-md-3 control-label">End Date : </label>          
                                                <input type="text" name="name" class="form-control"  value="11-05-2019">
                                            </div>  
                                            <div class="form-group" style="margin: 20px">
                                                <label for="" class="col-md-6 control-label">Notes (Optional) : </label>          
                                                <textarea name="note" class="form-control" cols="30" rows="10"></textarea>       
                                            </div>      
                                        </div>
                                        
                                        <div class="modal-footer">
                                            
                                            <button type="submit" style="text-align: center" class="btn btn-primary btn-save">Approve</button>
                                            <button type="submit" style="text-align: center" class="btn btn-danger" data-dismiss="modal">Reject</button>
                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div> 
                {{-- end edit modal --}}
                
                {{-- ini modal edit department --}}
                <div class="modal fade" id="modal-departmentEdit" tabindex="1" role="dialog" data-backdrop="static" aria-hidden="true">
                    <div class="modal-dialog" modal-lg>
                        <div class="modal-content">
                            <form action="#" method="post" class="form-horizontal" data-toggle="validator" >
                                {{csrf_field()}}   
                                
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h3 class="modal-title" id="modal-departmentEdit1"><b style="color: #367fa9;text-align: center;position: relative">Overtime Submission</b></h3>
                                </div>                                         
                                <div class="modal-body">
                                    <div class="form-group" style="margin: 20px">
                                        <label for="" class="col-md-6 control-label">Supervisor : </label>
                                        <input type="text" name="name" class="form-control"  value="Halim Cakra W">      
                                    </div>        
                                    
                                    <div class="form-group"  style="margin: 20px">
                                        <label for="" class="col-md-6 control-label">Overtime Reason : </label>                                             
                                        <textarea name="note" class="form-control" cols="30" rows="10">Perlu Lembur Dikarenakan Deadline besok pagi harus dikirim ke Client</textarea>  
                                    </div>   
                                    <div class="form-group" style="margin: 20px">
                                        <label for="" class="col-md-6 control-label">Start Time : </label>                    
                                        <input type="text" name="name" class="form-control"  value="17:30">
                                        
                                    </div>  
                                    <div class="form-group" style="margin: 20px">
                                        <label for="" class="col-md-6 control-label">End Date : </label>          
                                        <input type="text" name="name" class="form-control"  value="21:00">
                                    </div>             
                                </div>
                                <div class="modal-footer">                       
                                    <button type="submit" class="btn btn-primary btn-save">Approve</button>
                                    <button type="submit" class="btn btn-danger" data-dismiss="modal">Reject</button>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div> 
                {{-- end edit modal --}}
                
                {{-- ini modal edit department --}}
                <div class="modal fade" id="modal-departmentEdit2" tabindex="1" role="dialog" data-backdrop="static" aria-hidden="true">
                    <div class="modal-dialog" modal-lg>
                        <div class="modal-content">
                            <form action="#" method="post" class="form-horizontal" data-toggle="validator" >
                                {{csrf_field()}}   
                                
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h3 class="modal-title" id="modal-departmentEdit2"><b style="color: #367fa9;text-align: center;position: relative">Overtime Submission</b></h3>
                                </div>                                         
                                <div class="modal-body">
                                    <div class="form-group" style="margin: 20px">
                                        <label for="" class="col-md-6 control-label">Supervisor : </label>
                                        <input type="text" name="name" class="form-control"  value="Halim Cakra W">      
                                    </div>        
                                    
                                    <div class="form-group"  style="margin: 20px">
                                        <label for="" class="col-md-6 control-label">Overtime Reason : </label>                                             
                                        <textarea name="note" class="form-control" cols="30" rows="10">Perlu Lembur Dikarenakan Deadline besok pagi harus dikirim ke Client</textarea>  
                                    </div>   
                                    <div class="form-group" style="margin: 20px">
                                        <label for="" class="col-md-6 control-label">Start Time : </label>                    
                                        <input type="text" name="name" class="form-control"  value="17:30">
                                        
                                    </div>  
                                    <div class="form-group" style="margin: 20px">
                                        <label for="" class="col-md-6 control-label">End Date : </label>          
                                        <input type="text" name="name" class="form-control"  value="21:00">
                                    </div>             
                                </div>
                                <div class="modal-footer">                       
                                    <h3> Status :  <b style="color: green">Approved</b> </h3>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div> 
                {{-- end edit modal --}}
                
            </tfoot>
        </table>
        
        
    </div>
</div>   
</div> 
<script src="{{ asset ('dist/js/sweetalert2.all.min.js') }}"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
    
    function departmentForm(){
        $('#modal-department').modal('show');
        // $('#modal-department form')[0].reset();
    } 
    
</script>

</body>
@endcan    
@endsection