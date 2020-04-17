@extends ('layout')

@section('content')
	<div class="container">
<h1 class='title'>Edit Profile</h1>

<form METHOD ="POST" action="/profile/{{$userProfile->id}}/edit">
	@csrf
	@method('patch')

	<div class='row'>
	
		<div class="input-group mb-3 dynamic">
		  <div class="input-group-prepend dynamic">
		    	<label class="input-group-text dynamic">Position</label>
		  </div>
			  <select class="custom-select dynamic" name='position'>
			  	
			  	<option value="Goalkeeper">Goalkeeper</option>
			  	<option value="Defender">Defender</option>
			  	<option value="Midfielder">Midfielder</option>
			  	<option value="Attacker">Attacker</option>
			    
			  </select>

		</div>

		

		<div class="input-group mb-3">
		  <div class="input-group-prepend">
		    <span class="input-group-text">About Me</span>
		  </div>
		  <textarea class="form-control" placeholder="{{$userProfile->bio}}" name='bio' aria-label="With textarea">{{$userProfile->bio}}</textarea>
		</div>
	

	
		<div class="col-sm-1"><input class="btn btn-primary" type="submit" value="Edit Profile"></div>
		</form>

		<form METHOD ="POST" action="/profile/{{$userProfile->id}}">
		  @csrf
		  @method('delete')
		<div class="col-sm-1 ml-3"><a class="btn btn-danger" data-toggle="modal" data-target='#myModal' style="color: white">Delete</a></div>
		    
		     


		    <!-- Modal -->
		    <div id="myModal" class="modal fade" role="dialog">
		      <div class="modal-dialog modal-dialog-centered">

		        <!-- Modal content-->
		        <div class="modal-content">
		          <div class="modal-body">
		            <p>Are you sure you want to delete this Profile?</p>
		          </div>
		          <div class="modal-footer">
		            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		             <input id='delete' data-toggle="modal"  class="btn btn-danger ml-3" type="submit" value="Delete">
		          </div>
		        </div>

		      </div>
		    </div>





		</form>
	</div>


	

	





@endsection