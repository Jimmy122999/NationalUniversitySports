@extends('layout')

@section('content')

<div id="header-wrapper">
	
	<div id="header-featured">
		<div id="banner-wrapper">
			
	</div>
</div>
<div id="wrapper">
	<div id="page" class="container">
		@guest
		<div class="jumbotron">
		  <h1 class="display-4">Welcome to National University Sports</h1>
		  <p class="lead">This is an application that is used to track the performance of university teams playing eachother across a season</p>
		  <hr class="my-4">
		  <p>There is also builty in social tools for teams to communicate messages and even for players to have their own profiles</p>
		  <p class="lead">
		    <a class="btn btn-primary btn-lg" href="/register" role="button">Get Started</a>
		  </p>
		</div>
		@else
	<div class="container">
		
		<div class="row border">
			<div class="col-md-12 border mb-3"><h1 class="font-weight-bold"><center>Recent Results</center></h1></div>
		</div>
		
		@foreach($results as $result)
	<div class="container border mb-3">
		<div class="row ">
			<div class="col-md-12 "><h1><center>{{$result->fixture->homeTeam->division->sport->name}} - {{$result->fixture->homeTeam->division->name}}</center></h1></div>
		</div>
		<div class="row ">
			<div class="col-md-2 "></div>
			<div class="col-md-2 "><img src="/images/avatarPlaceHolder.jpg" class="card-img-top"></div>
			<div class="col-md-1 "><center><h1 class="bold">{{$result->home_team_score}}</h1></center></div>
			<div class="col-md-1 "><center><h1 class="bold">-</h1></center></div>
			<div class="col-md-1 "><center><h1 class="bold">{{$result->away_team_score}}</h1></center></div>
			<div class="col-md-2 "><img src="/images/avatarPlaceHolder.jpg" class="card-img-top"></div>


		</div>

		<div class="row ">
			<div class="col-md-2 "></div>
			<div class="col-md-2 "><center><a href="/teams/{{$result->fixture->homeTeam->id}}"><p class="font-weight-bold">{{$result->fixture->homeTeam->name}}</p></a></center></div>
			<div class="col-md-1 "></div>
			<div class="col-md-2 "></div>
			<div class="col-md-2 "><center><a href="/teams/{{$result->fixture->awayTeam->id}}">{{$result->fixture->awayTeam->name}}</a></center></div>


		</div>
		</div>
		@endforeach

	</div>
</div>
		@endguest

	
</div>

@endsection