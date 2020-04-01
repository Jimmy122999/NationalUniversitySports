@extends('admin/layout')

@section('content')

<div class='container-fluid' width:>
	
		<div class='row'>
			<div class='col-1 '></div>  <!-- Pushing container in  -->
			<div class='col border'><h1>Squad</h1>
				<ul class="list-group">
				@foreach ($team->member as $teamMember)
				@if (isset($teamMember->profile->id))
				<li class="list-group-item"><a href="/admin/profile/{{$user->profile->id}}">{{ $teamMember->name }}</a></li>
				
				@else
				<li class="list-group-item">{{ $teamMember->name }}</li>
				@endif
				@endforeach
				</ul>



			</div>
			<div class='col-6 border'><h1>{{$team->name}}</h1> 
					<div class="container">
						@if($user->hasTeam == 0)
						<a class="btn btn-primary ml-6" href="/admin/teams/{{$team->id}}/apply" role="button">Join Team</a>
						@endif
						<a class="btn btn-primary ml-6" href="/admin/teams/{{$team->id}}/applications" role="button">View Applications</a>
						@if(isset($teamMember))
						<a class="btn btn-primary ml-6" href="/admin/teams/{{$team->id}}/edit" role="button">Edit Team</a>
						<a class="btn btn-primary ml-6" href="/admin/teams/{{$team->id}}/{{$teamMember->id}}/post" role="button">Create New Post</a>
						<a id='leave' class="btn btn-danger ml-6" href="/admin/teams/{{$team->id}}/{{$teamMember->id}}/leave" role="button">Leave Team</a>
					    <div class="row justify-content">
					        <div class="col-md-8 py-4">


					        	@foreach ($posts as $post)
					            <div class="card mb-4">
									
					                <div class="card-header">
					                	<div class="row">
					                	<div class="col-md-10">
					                	@if(isset($post->userProfileId))	
					                <a href="/admin/profile/{{$post->userProfileId}}">{{$post->name}}</a><br>	{{$post->created_at->format('d/m/Y H:i')}}
					                	@else
					                	{{$post->name}}<br>	{{$post->created_at->format('d/m/Y H:i')}}
					                	@endif

					                	</div>
					                	<div class="col-md-2">
											<a class="btn btn-primary" href="/admin/teams/{{$team->id}}/{{$post->teamMemberId}}/post/{{$post->id}}/edit" role="button">Edit</a>
					                	</div>
					                </div>

					                </div>

					                <div class="card-body">
					                   {{$post->body}}
					                </div>
					            </div>
					           
					            @endforeach
					        </div>
					    </div>
					    @else
					    
					   @endif

					</div>


			</div>
			<div class='col border'><h1>Upcoming Fixtures</h1>
				<tbody>
					
					
					@foreach($allFixtures as $fixture)
					<tr>
						<td><a href="/admin/teams/{{$fixture->home_team_id}}"><center>{{$fixture->homeTeam->name}}</center></a></td>
						<td><center>{{$fixture->time->format('d/m/Y H:i')}}</center><br><center>{{$fixture->notes}}</center></td>
						<td><a href="/admin/teams/{{$fixture->away_team_id}}"><center>{{$fixture->awayTeam->name}}</center></a></td>
					</tr>		
					@endforeach


					
				</tbody>
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