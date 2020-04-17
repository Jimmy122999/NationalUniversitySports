@extends ('layout')

@section ('content')
<div class = container>
	<h1>{{$team->name}}'s Applications</h1>
<ul class="list-group">
 
  @foreach ($team->pendingApplication as $application)
  <div class="row">
  	<div class="col-sm-8 mb-1">
  <li class ='list-group-item'>
    {{ $application->name }} / {{$application->user->name}}
  </li>

  </div>
  	 	 <div class="col-sm-1">
  	 	 	<form method="POST" action='/teams/{{$team->id}}/{{$application->id}}/applications/approve'>
  	 	 		@csrf
  	 	 		 <input class="btn btn-success" type="submit" value="Approve">
  	 	 	</form>
  	 	 </div>
  	 	 <div class="col-sm-1">
  	 	 	<form method="POST" action='/teams/{{$team->id}}/{{$application->id}}/applications/deny'>
  	 	 		@csrf
  	 	 		 <input class="btn btn-danger" type="submit" value="Deny">
  	 	 	</form>
  		 </div>
    
  @endforeach

  @endsection