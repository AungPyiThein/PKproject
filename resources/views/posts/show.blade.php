@extends('layouts.app')

@section('content')
<a href="/posts" class="btn btn-secondary">Go back</a>

<div style="color: white">
<h1>{{$post->title}}</h1>
</div>
<div class="row">
	<div class="col-md-12">
		<img style="width: 100" src="/storage/cover_images/{{$post->cover_image}}" alt="">
		
	</div>

</div>
<p>{{$post->body}}</p>
<hr>
<small>Written on {{$post->created_at}}</small>
<p>Viewer: {{ $post->visit_count }}</p>
<hr>
@if(!Auth::guest())
@if(Auth::user()->id == $post->user_id)
<div class="row">
	<div>
	<a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
	{!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
	
	{{Form::hidden('_method', 'DELETE')}}
	{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
	{!!Form::close()!!}
	</div>
</div>
@endif
@endif
@endsection