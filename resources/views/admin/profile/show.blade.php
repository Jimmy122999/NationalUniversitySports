@extends('admin/layout')

@section('content')

<div class='container-fluid' width:>
<div class='row'>
			<div class='col-1 '></div>  <!-- Pushing container in  -->
			<div class='col border'><h1>About Me</h1>
				<ul class="list-group">
</ul>
</div>
<div class='col-6 border'>
</div>
<div class='col border'><h1>{{$userProfile->member->name}}</h1>
				<ul class="list-group">
				  <li class="list-group-item">{{$userProfile->id}}</li>
				  <li class="list-group-item">Dapibus ac facilisis in</li>
				  <li class="list-group-item">Morbi leo risus</li>
				  <li class="list-group-item">Porta ac consectetur ac</li>
				  <li class="list-group-item">Vestibulum at eros</li>
				</ul>
			</div>
		<div class='col-1'></div> <!-- Pushing container in  -->
		</div>

		@endsection