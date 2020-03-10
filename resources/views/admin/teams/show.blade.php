@extends('admin/layout')

@section('content')

<div class='container-fluid' width:>
	
		<div class='row'>
			<div class='col-1 '></div>  <!-- Pushing container in  -->
			<div class='col border'><h1>Squad</h1>
				<ul class="list-group">
				@foreach ($team->member as $teamMember)
				<li class="list-group-item">{{ $teamMember->name }}asd</li>
				@endforeach
				</ul>



			</div>
			<div class='col-6 border'><h1>{{$team->name}}</h1></div>
			<div class='col border'><h1>Top Scorers</h1>
				<ul class="list-group">
				  <li class="list-group-item">Cras justo odio</li>
				  <li class="list-group-item">Dapibus ac facilisis in</li>
				  <li class="list-group-item">Morbi leo risus</li>
				  <li class="list-group-item">Porta ac consectetur ac</li>
				  <li class="list-group-item">Vestibulum at eros</li>
				</ul>
			</div>
			<div class='col-1'></div> <!-- Pushing container in  -->
		</div>
	
</div>

@endsection