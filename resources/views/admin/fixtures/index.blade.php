@extends('admin/layout')


@section('content')

<table class="table table-bordered">
	<tbody>
		@foreach($fixtures as $fixture)
		<tr>
			<td>{{$fixture->homeTeam->name}}</td>
			<td>{{$fixture->time->format('d/m/Y H:i')}}</td>
			<td>{{$fixture->awayTeam->name}}</td>
		</tr>		
		<tr>


		@endforeach
	</tbody>
</table>

@endsection