@extends('layouts.app')

@section('content')

<div class="container">
    <h1>{{ $news1->title }}</h1>
    <p class="lead">{{ $news1->body }}  
    </p>
    <hr>
    {!! Form::open(['method' => 'DELETE', 'route' => ['dashboard.destroy', $news1->id] ]) !!}
    <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a>
    @can('Edit News')
    <a href="{{ route('dashboard.edit', $news1->id) }}" class="btn btn-info" role="button"><i class="fa fa-edit"></i></a>
    @endcan
    @can('Delete News')
    {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm'] )  }}
    @endcan
    {!! Form::close() !!}
</div>

@endsection