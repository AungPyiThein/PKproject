@extends('layouts.app')

@section('content')

<h1>Posts</h1>
<br>
	@if(count($posts) > 1)
	<div class="card">
			<ul class="list-group list-group-flush">

	@foreach($posts as $post)

		<li class="list-group-item">	
				<h3><a href="/posts/{{$post->id}}"> {{$post->title}}</a></h3>
			<small>
				Written on {{$post->created_at}}
			</small>
		</li>
			</ul>
			
		</div>
	@endforeach
	@else

	@endif
@endsection