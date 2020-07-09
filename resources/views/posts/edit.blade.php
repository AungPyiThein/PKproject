@extends('layouts.app')

@section('content')
       <h1>Edit Post</h1>
		{!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}


    		<div class = 'form-group'>
    			{{Form::label('title', 'Title')}}
    			{{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' =>'Title'])}}
    		</div>

    			<div class = 'form-group'>
    			{{Form::label('body', 'Body')}}
    			{{Form::textarea('body', $post->body, ['class' => 'form-control', 'placeholder' =>'Body'])}}
    		</div>
              <div class="form-group">
                {{Form::file('cover_image')}}
            </div>
            <div class="row"> 
                <div class="col-md-10">
            {{Form::hidden('_method', 'PUT')}}
    		{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
		  {!! Form::close() !!}
          </div>
          <div class="col-md-2">
    <a href="/posts/{{$post->id}}" class="btn btn-secondary">Go back</a>
    </div>
</div>
@endsection