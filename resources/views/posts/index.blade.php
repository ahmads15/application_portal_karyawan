@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h3><i class="fa fa-newspaper-o" aria-hidden="true"></i> </h3></div>
                <div class="panel-heading">Page {{ $posts->currentPage() }} of {{ $posts->lastPage() }}</div>
                @foreach ($posts as $post)
                <div class="panel-body">
                    <li style="list-style-type:disc">
                        <a href="{{ route('posts.Dashboard', $post->id ) }}"><b>{{ $post->title }}<br> {{$post->created_at }} | {{auth()->user()->name}}</b><br>
                            {{-- <p class="teaser">
                                {{  str_limit($post->body, 50) }} {{-- Limit teaser to 100 characters --}}
                            </p> 
                        </a>
                    </li>
                </div>
                @endforeach
            </div>
            <div class="text-center">
                {!! $posts->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection