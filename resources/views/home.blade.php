@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                    <a href="/create" class="btn btn-primary" class="col-md-4">Create Post</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    
                <div>
                 <form action="/search" method="get">
                  <div class="input-group" class="col-md-4">
                   <input type="search" name="search" class="form-control">
                  <span class="input-group-prepend">
                <button type="submit" class="btn btn-success">Search</button>
                   </span>
                 </div>
                 </form>
              </div>
            </div>
            <br>
                    <h3>Your Blog Post</h3>
            <br>

                    @if(count($posts) > 0)
                    <table class="table table-striped">
                        <tr>
                            <th>Title</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach($posts as $post)
                        <tr>
                            <th>{{$post->title}}</th>
                            <th><a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a></th>
                            <th><a href="/posts/{{$post->id}}" class="btn btn-success">Open</a></th>
                        </tr>
                        @endforeach
                    </table>
                    @else
                    <p>You have no posts.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
