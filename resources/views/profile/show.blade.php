@extends('layout')

@section('content')

<div class='container-fluid' width:>
<div class='row'>
		<div class='col-1 '></div>  <!-- Pushing container in  -->
		<div class='col border'>
			<div class="card" style="width: 18rem;">
				@if(isset($userProfile->image))
			  <img src="/storage/{{$userProfile->image}}" class="card-img-top">
			  	@can('update' , [App\UserProfile::class , $userProfile])
			 
			    	<form method="POST" action="/profile/{{$userProfile->id}}/image" enctype="multipart/form-data">
			    		@csrf
			  	  	<input type="file" name="image">
			  	  	<div>{{$errors->first('image')}}</div>
			  	  	<input class="btn btn-primary" type="submit" value="Edit Player Picture">
			  	 </form>
			  	 @endcan
			  
			  	@else
			  	
			  	<img src="/images/avatarPlaceHolder.jpg" class="card-img-top">
			  	@can('update' , [App\UserProfile::class , $userProfile])
			  	<form method="POST" action="/profile/{{$userProfile->id}}/image" enctype="multipart/form-data">
			  		@csrf
				  	<input type="file" name="image">
				  	<div>{{$errors->first('image')}}</div>
				  	<input class="btn btn-primary" type="submit" value="Upload Player Picture">
				 </form>
				 @endcan
			  	@endif
			  <div class="card-body">
			    <p class="card-text">Name: {{$userProfile->member->name}}</p>
			    <p class="card-text">Team: <a href="/teams/{{$userProfile->member->team->id}}">{{$userProfile->member->team->name}}</p></a>
			    <p class="card-text">Position: {{$userProfile->position}}</p>
			    <p class="card-text">About me: {{$userProfile->bio}}</p>
			  </div>
			</div>	
			
		</div>
			<div class='col-md-6 border'>
				<h1>{{$userProfile->member->name}}</h1>
				@can('update' , [App\UserProfile::class , $userProfile])
				<a class="btn btn-primary ml-6" href="/profile/{{$userProfile->id}}/post/create" role="button">Create New Post</a>
				<a class="btn btn-primary ml-6" href="/profile/{{$userProfile->id}}/edit" role="button">Edit Profile</a>
				@endcan
				
				    <div class="row justify-content">
				        <div class="col-md-8 py-4">

				        	@foreach ($userProfile->post as $post)
				            <div class="card mb-4">
								
				                <div class="card-header">
				                	<div class="row">
				                	<div class="col-md-10">
				                	
				                	{{$userProfile->member->name}}<br>	{{$post->created_at->format('d/m/Y H:i')}}
				                	

				                	</div>
				                	@can('update' , [App\UserProfile::class , $userProfile])
				                	<div class="col-md-2">
										<a class="btn btn-primary" href="/profile/{{$userProfile->id}}/post/{{$post->id}}/edit" role="button">Edit</a>
				                	</div>
				                	@endcan
				                </div>

				                </div>

				                <div class="card-body">
				                   {{$post->body}}
				                </div>
				            </div>
				           
				            @endforeach
				        </div>
				    </div>

			</div>
			<div class='col border'><h2 class="font-weight-bold"><center>Upcoming Fixtures</center></h2>
							<div class="row">
							<tbody>
								
								
								@foreach($allFixtures as $fixture)
								<div class='col-md-12 mb-2 border'>
								<tr>
									<td><center>{{$fixture->time->format('d/m/Y H:i')}}</center></td>
									<td><a href="/teams/{{$fixture->home_team_id}}"><center>{{$fixture->homeTeam->name}}</center></a></td>
									<td><center>VS</center></td>
									
									<td><a href="/teams/{{$fixture->away_team_id}}"><center>{{$fixture->awayTeam->name}}</center></a></td>
									<td><center>{{$fixture->notes}}</center></td>
								</tr>		
							</div>
								@endforeach


								
							</tbody>
							{{$allFixtures->links()}}
							</div>

						</div>
		<div class='col-1'></div> <!-- Pushing container in  -->
</div>

					@endsection