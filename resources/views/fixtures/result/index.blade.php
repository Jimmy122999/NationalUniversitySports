@extends('layout')


@section('content')
<div class = container>
	<div class="row">
		<div class='col-md-11'><center><h1>Latest Results</h1><center></div>
	</div>
	<table class="table table-bordered">
		<tbody>
			@if(isset($results))
			@foreach($results as $result)
			<tr>
				<td><a href="/teams/{{$result->homeTeam->id}}"><center>{{$result->homeTeam->name}}</center></a></td>
				<td><center>{{$result->result->home_team_score}}</center></td>
				<td><center>-</center></td>
				<td><center>{{$result->result->away_team_score}}</center></td>
				<td><a href="/teams/{{$result->awayTeam->id}}"><center>{{$result->awayTeam->name}}</center></a></td>
				@can('update' , App\Fixture::class)
				<td><center><a class="btn btn-primary ml-auto" href="/fixtures/{{$result->id}}/result/{{$result->result->id}}/edit" role="button">Edit</a></center></td>
				@endcan
				
				
			</tr>	

			
			


			@endforeach
			@endif
		</tbody>

	</table>
	

</div>

@endsection