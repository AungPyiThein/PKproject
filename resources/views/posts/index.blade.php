@extends('layouts.app')

@section('content')
<div class="row">
<div class="col-md-6" style="color: white">
<h1>Posts</h1>

</div>
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;

	<div class="dropdown">
  <button style="background-color: black;" class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Category
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
  
  	
    <a class="dropdown-item" href="http://localhost:8000/search?search=business">Business</a>
    
    
    <a class="dropdown-item" href="http://localhost:8000/search?search=sport">Sport</a>
    
   
    <a class="dropdown-item" href="http://localhost:8000/search?search=crime">Crime</a>
    

  </div>
</div>

<div>
<a href="/mostview" style="background-color: black;" class="btn btn-primary">
	Most Viewed
</a>
</div>



                    
<div class="col-md-6">
	<form action="/search" method="get">
		<div class="input-group">
			<input type="search" name="search" class="form-control">
			<span class="input-group-prepend">
				<button type="submit" style="background-color: black;" class="btn btn-primary">Search</button>
			</span>
		</div>
	</form>
</div>
</div>
<br>
@if(count($posts) > 0)

<div class="card">
<ul class="list-group list-group-flush">

@foreach($posts as $post)
<div class="row">
<div class="col-md-4">
<img style="width: 100%" src="/storage/cover_images/{{$post->cover_image}}" alt="">
</div>
<div class="col-md-8">
<h3> <a href="/posts/{{$post->id}}"> {{$post->title}}</a></h3>
<small>Written on {{$post->created_at}}</small>

<p>Viewer: {{ $post->visit_count }}</p>
</form>
</div>
</div>

@endforeach

</ul>
</div>
@endif
<div>
	<a href="https://www.telenor.com.mm/"><img src="https://www.telenor.com.mm/sites/default/files/GIF-Final-Final.gif" width="300" height="200"></a>

	<a href="https://ads.google.com/intl/en_us/lp/coupons/"><img src="https://i.imgur.com/Mq8lCd0.gif" width="300" height="200"></a>

	<a href="https://www.google.com/maps"><img src="https://media.giphy.com/media/3ohs82JOAJiy0mP1fi/giphy.gif" width="300" height="200">
	</a>
</div>
<br>
<div>
{!! $posts->links() !!}

</div>


@endsection