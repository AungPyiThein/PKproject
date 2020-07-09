@extends('layouts.app')

@section('content')
<div style="color: white">
       <h1>{{$title}}</h1>
       <p>This is our location.</p>
</div>
       <div id="googleMap">
       <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3818.97625380704!2d96.15308131540596!3d16.82753408841646!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c193d059e6f821%3A0x3a82bf9d9bdfe536!2sMyanmar%20Plaza%20Office%20Tower!5e0!3m2!1sen!2smm!4v1593745763900!5m2!1sen!2smm" width="800" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

       </div>
  @endsection
 