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
          fdgdfgdfg
		  <p class="lead">
		    <a class="btn btn-primary btn-lg" href="/register" role="button">Get Started</a>
		  </p>
		</div>
		@else
	<div class="container">

		<div class="row">
			<div class="col-md-12 mb-3 rounded-pill border"><h1 class="font-weight-bold"><center>Recent Results</center></h1></div>
		</div>

		@foreach($results as $result)
	<div class="card mb-3  rounded-lg">
		<div class="row ">
			<div class="col-md-11 "><h2><center><a class="text-reset text-decoration-none " href="/sports/{{$result->fixture->homeTeam->division->sport->name}}">{{$result->fixture->homeTeam->division->sport->name}}</a> - <a class="text-reset text-decoration-none" href="/sports/{{$result->fixture->homeTeam->division->sport->name}}/{{$result->fixture->homeTeam->division->id}}">{{$result->fixture->homeTeam->division->name}}</a></center></h2></div>
		</div>
		<div class="row ">
			<div class="col-md-2"></div>

			<div class="col-md-2 ">
				@if(isset($result->fixture->homeTeam->image))
				<img src="/storage/{{$result->fixture->homeTeam->image}}" class="card-img-top">
				@else
				<img src="/images/avatarPlaceHolder.jpg" class="card-img-top">
				@endif
			</div>
			<div class="col-md-1 "><center><h1 class="bold">{{$result->home_team_score}}</h1></center></div>
			<div class="col-md-1 "><center><h1 class="bold">-</h1></center></div>
			<div class="col-md-1 "><center><h1 class="bold">{{$result->away_team_score}}</h1></center></div>
			<div class="col-md-2 ">
							@if(isset($result->fixture->awayTeam->image))
							<img src="/storage/{{$result->fixture->awayTeam->image}}" class="card-img-top">
							@else
							<img src="/images/avatarPlaceHolder.jpg" class="card-img-top">
							@endif
						</div>


		</div>

		<div class="row ">
			<div class="col-md-2 "></div>
			<div class="col-md-2 "><center><a class="text-reset text-decoration-none" href="/teams/{{$result->fixture->homeTeam->id}}"><h3 class="font-weight-bold">{{$result->fixture->homeTeam->name}}</h3></a></center></div>
			<div class="col-md-1 "></div>
			<div class="col-md-2 "></div>
			<div class="col-md-2 "><center><a class="text-reset text-decoration-none" href="/teams/{{$result->fixture->awayTeam->id}}"><h3 class="font-weight-bold">{{$result->fixture->awayTeam->name}}</h3></a></center></div>


		</div>
		</div>
		@endforeach


	</div>
</div>
		@endguest


</div>

@endsection
