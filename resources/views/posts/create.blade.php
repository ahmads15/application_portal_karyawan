@extends('layouts.app')



@section('content')
    <div class="row">
            <div class="col-md-6 col-md-offset-3" style="margin-bottom: 50px">
                <div id="" style="margin-top: 5%">
    
                    <h3 style="text-align: center">
                        <strong>Add New Post</strong>
                    </h3>
    
                    <form action="{{route('posts.store')}}" class="form-horizontal" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
    
    
                        <div class="form-group" style="margin: 20px">
                            <label for="">Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>

                        
                        <div class="form-group" style="margin: 20px">
                                <label for="">Body</label>
                                <input type="text" name="body" class="form-control">
                        </div>
    
                        <div class="form-group" style="margin: 20px">
                            <button class="btn btn-primary" style="text-align: center; width: 100%">Create News</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection