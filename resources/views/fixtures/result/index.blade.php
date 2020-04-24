@extends('layout')


@section('content')
<div class = container>
	<div class="container">
			
			<div class="row">
				<div class="col-md-12 mb-3 rounded-pill border"><h1 class="font-weight-bold"><center>Results for <a class="text-reset text-decoration-none " href="/sports/{{$division->sport->name}}">{{$division->sport->name}}</a> - <a class="text-reset text-decoration-none" href="/sports/{{$division->sport->name}}/{{$division->id}}">{{$division->name}}</a></center></h1></div>
			</div>
			
			@foreach($results as $result)
		<div class="card mb-3  rounded-lg">
			<div class="row ">
				<div class="col-md-11 "><h2><center></center></h2></div>
			</div>
			<div class="row ">
				<div class="col-md-2"></div>
				
				<div class="col-md-2 ">
					@if(isset($result->homeTeam->image))
					<img src="/storage/{{$result->homeTeam->image}}" class="card-img-top">
					@else
					<img src="/images/avatarPlaceHolder.jpg" class="card-img-top">
					@endif
				</div>
				<div class="col-md-1 "><center><h1 class="bold">{{$result->result->home_team_score}}</h1></center></div>
				<div class="col-md-1 "><center><h1 class="bold">-</h1></center></div>
				<div class="col-md-1 "><center><h1 class="bold">{{$result->result->away_team_score}}</h1></center></div>
				<div class="col-md-2 ">
								@if(isset($result->awayTeam->image))
								<img src="/storage/{{$result->awayTeam->image}}" class="card-img-top">
								@else
								<img src="/images/avatarPlaceHolder.jpg" class="card-img-top">
								@endif
							</div>


			</div>

			<div class="row ">
				<div class="col-md-2 "></div>
				<div class="col-md-2 "><center><a class="text-reset text-decoration-none" href="/teams/{{$result->homeTeam->id}}"><h3 class="font-weight-bold">{{$result->homeTeam->name}}</h3></a></center></div>
				<div class="col-md-1 "></div>
				<div class="col-md-2 "></div>
				<div class="col-md-2 "><center><a class="text-reset text-decoration-none" href="/teams/{{$result->awayTeam->id}}"><h3 class="font-weight-bold">{{$result->awayTeam->name}}</h3></a></center></div>


			</div>
			</div>
			@endforeach

			{{$results->links()}}

	
	

</div>

@endsection