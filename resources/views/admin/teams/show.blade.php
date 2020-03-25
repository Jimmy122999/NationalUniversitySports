@extends('admin/layout')

@section('content')

<div class='container-fluid' width:>
	
		<div class='row'>
			<div class='col-1 '></div>  <!-- Pushing container in  -->
			<div class='col border'><h1>Squad</h1>
				<ul class="list-group">
				@foreach ($team->member as $teamMember)
				<li class="list-group-item">{{ $teamMember->name }}</li>
				@endforeach
				</ul>



			</div>
			<div class='col-6 border'><h1>{{$team->name}}</h1> 
					<div class="container">
						<a class="btn btn-primary ml-6" href="/admin/teams/{{$team->id}}/edit" role="button">Edit Team</a>
					    <div class="row justify-content">
					        <div class="col-md-8">
					            <div class="card">
					                <div class="card-header">Dashboard</div>

					                <div class="card-body">
					                   
					                </div>
					            </div>
					        </div>
					    </div>
					</div>


			</div>
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
		<div class='row'>
			<div class ='col-6'>
	
			<
		</div>
</div>


@endsection