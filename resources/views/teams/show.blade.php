@extends('layout')

@section('content')

<div class='container-fluid' width:>
	
		<div class='row'>
			<div class='col-md-1 '></div>  <!-- Pushing container in  -->
			<div class='col border'><h1>Squad</h1>
				<ul class="list-group">
				@foreach ($team->member as $teamMember)
				@if (isset($teamMember->profile->id))
				<li class="list-group-item"><a href="/profile/{{$teamMember->profile->id}}">{{ $teamMember->name }}</a></li>
				
				@else
				<li class="list-group-item">{{ $teamMember->name }}</li>
				@endif
				@endforeach
				</ul>



			</div>
			<div class='col-md-6 border'><h1>{{$team->name}}</h1> 
					<div class="container">
						@if(isset($user))
						@if($user->hasTeam == 0)
						<a class="btn btn-primary ml-6" href="/teams/{{$team->id}}/apply" role="button">Join Team</a>
						@endif
						@endif
						@can('viewApplications' , [App\Team::class , $team])
						<a class="btn btn-primary ml-6" href="/teams/{{$team->id}}/applications" role="button">View Applications</a>
						@endcan
						
						@can('update' , App\Team::class)
						<a class="btn btn-primary ml-6" href="/teams/{{$team->id}}/edit" role="button">Edit Team</a>
						@endcan
						@if(isset($teamMember))
						@can('view' , [App\Team::class , $team])
						<a class="btn btn-primary ml-6" href="/teams/{{$team->id}}/{{Auth::user()->member->id}}/post" role="button">Create New Post</a>
						@endcan

						@can ('leave' , [App\Team::class , $team])
						<a id='leave' class="btn btn-danger ml-6" href="/teams/{{$team->id}}/{{Auth::user()->member->id}}/leave" role="button">Leave Team</a>
						@endcan
					    <div class="row justify-content">
					        <div class="col-md-8 py-4">


					        	@foreach ($posts as $teamPost)
					            <div class="card mb-4">
									
					                <div class="card-header">
					                	<div class="row">
					                		@if(isset($teamPost->userProfileImage))
					                		<div class="col-md-2">
					                			<img src="/storage/{{$teamPost->userProfileImage}}" class="card-img-top">
					                		</div>
					                		@else
					                		<div class="col-md-2">
					                			<img src="/images/avatarPlaceHolder.jpg" class="card-img-top">
					                		</div>
					                		@endif

					                	<div class="col-md-8">
					                	@if(isset($teamPost->userProfileId))	
					                <a href="/profile/{{$teamPost->userProfileId}}">{{$teamPost->name}}</a><br>	{{$teamPost->created_at->format('d/m/Y H:i')}}
					                	@else
					                	{{$teamPost->name}}<br>	{{$teamPost->created_at->format('d/m/Y H:i')}}
					                	@endif

					                	</div>
					                	@can('update' , [App\TeamPost::class , $teamPost])
					                	<div class="col-md-2">
											<a class="btn btn-primary" href="/teams/{{$team->id}}/{{$teamPost->teamMemberId}}/post/{{$teamPost->id}}/edit" role="button">Edit</a>
					                	</div>
					                	@endcan
					                </div>

					                </div>

					                <div class="card-body">
					                   {{$teamPost->body}}
					                </div>
					            </div>
					           
					            @endforeach
					        </div>
					    </div>
					   
					  
					    
					   @endif

					</div>


			</div>
			<div class='col border'><h1>Upcoming Fixtures</h1>
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
				</div>
			</div>
			<div class='col-1'></div> <!-- Pushing container in  -->
		</div>
		<div class='row'>

			<div class ='col-6'>
	
			
		</div>
</div>


@endsection

<script type="text/javascript">
	window.onload = function(){
	var leaveTeam = document.getElementById('leave');

	leave.onclick = function(){
		var x = confirm('Are you sure you want to leave this team?');
		if(x == true){
			return true;
		}
		else
		{
			return false;
		}
	}
}



</script>