@extends('admin/layout')

@section('content')

<div class='container-fluid' width:>
<div class='row'>
		<div class='col-1 '></div>  <!-- Pushing container in  -->
		<div class='col border'>
			<div class="card" style="width: 18rem;">
				@if(isset($userProfile->image))
			  <img src="/storage/{{$userProfile->image}}" class="card-img-top">
			    	<form method="POST" action="/admin/profile/{{$userProfile->id}}/image" enctype="multipart/form-data">
			    		@csrf
			  	  	<input type="file" name="image">
			  	  	<div>{{$errors->first('image')}}</div>
			  	  	<input class="btn btn-primary" type="submit" value="Edit Player Picture">
			  	 </form>
			  	@else
			  	<img src="/images/avatarPlaceHolder.jpg" class="card-img-top">
			  	<form method="POST" action="/admin/profile/{{$userProfile->id}}/image" enctype="multipart/form-data">
			  		@csrf
				  	<input type="file" name="image">
				  	<div>{{$errors->first('image')}}</div>
				  	<input class="btn btn-primary" type="submit" value="Upload Player Picture">
				 </form>
			  	@endif
			  <div class="card-body">
			    <p class="card-text"><h1>{{$userProfile->member->name}}</h1></p>
			  </div>
			</div>	
			
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