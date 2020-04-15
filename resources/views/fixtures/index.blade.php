@extends('layout')


@section('content')
<div class = container>
	<div class="row">
		<div class='col-md-12'><center><h1>Upcoming Fixtures</h1><center></div>
	</div>
	<table class="table table-bordered">
		<tbody>

			@foreach($fixtures as $fixture)
			<tr>
				<td><a href="/teams/{{$fixture->homeTeam->id}}"><center>{{$fixture->homeTeam->name}}</center></a></td>
				<td><center>{{$fixture->time->format('d/m/Y H:i')}}</center><br><center>{{$fixture->notes}}</center></td>
				<td><a href="/teams/{{$fixture->awayTeam->id}}"><center>{{$fixture->awayTeam->name}}</center></a></td>
				@can('update' , App\Fixture::class)
				<td><center><a class="btn btn-primary ml-auto" href="/fixtures/{{$fixture->id}}/result" role="button">Enter Result</a></center></td>
				@can('create' , App\Fixture::class)
				<td><center><a class="btn btn-primary ml-auto" href="/fixtures/{{$fixture->id}}/edit" role="button">Edit</a></center></td>
				@endcan
				@endcan
				@can('captainEdit' , [App\Fixture::class , $fixture])
				<td><center><a class="btn btn-primary ml-auto" href="/fixtures/{{$fixture->id}}/edit-information" role="button">Add Information</a></center></td>
				@endcan
			</tr>		
			
			


			@endforeach
		</tbody>
		{{$fixtures->links()}}

	</table>
	@can('create' , App\Fixture::class)
	<a class="btn btn-primary ml-auto" href="/fixtures/create" role="button">Create A New Fixture</a>
	@endcan

</div>

@endsection