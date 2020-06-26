@extends('layouts.app')

@section('content')
       <h1>{{$title}}</h1>
       @if(count($services) > 0)
   <ui>
       @foreach($services as $service)
   		    <li>{{$service}}</li>
       @endforeach
   </ui>
       @endif
  @endsection