@extends ('admin/layout')

@section ('content')
<div class = container>
	<h1>{{$team->name}}'s Applications</h1>
<ul class="list-group">
 
  @foreach ($team->application as $application)
  <div class="row">
  	<div class="col-sm-9 mb-1">
  <li class ='list-group-item'>
  	<a href='/admin/teams/{{$team->id}}/{{$application->id}}'>
  		{{ $application->name }}</a>
      
  </li>
  @endforeach

  @endsection