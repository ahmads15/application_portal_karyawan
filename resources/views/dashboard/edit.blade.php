@extends('layouts.app')

@section('content')
<div class="row">
    
    <div class="col-md-8 col-md-offset-2">
        
        <h1>Edit News</h1>
        <hr>
        {{ Form::model($news, array('route' => array('dashboard.update', $news->id), 'method' => 'PUT')) }}
        <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', null, array('class' => 'form-control')) }}<br>
            {{ Form::label('body', 'Post Body') }}
            {{ Form::textarea('body', null, array('class' => 'form-control')) }}<br>            
            {{ Form::label('footer', 'Footer') }}
            {{ Form::text('footer', null, array('class' => 'form-control')) }}<br>           
            {{ Form::submit('Save Changes', array('class' => 'btn btn-primary')) }}
            
            {{ Form::close() }}
        </div>
    </div>
</div>

@endsection