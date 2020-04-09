@extends('layout')


@section('content')
<div class = container>
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
			</tr>		
			
			


			@endforeach
		</tbody>

	</table>
	@can('create' , App\Fixture::class)
	<a class="btn btn-primary ml-auto" href="/fixtures/create" role="button">Create A New Fixture</a>
	@endcan

</div>

@endsection