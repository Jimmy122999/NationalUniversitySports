@extends ('admin/layout')

@section('content')
	<div class="container">
<h1 class='title'>Create a Profile</h1>

<form METHOD ="POST" action="/admin/profile/create">
	@csrf
	

	
	
		<div class="input-group mb-3 dynamic">
		  <div class="input-group-prepend dynamic">
		    	<label class="input-group-text dynamic">Position</label>
		  </div>
			  <select class="custom-select dynamic" name='position'>
			  	<option value="#" selected='true' disabled="true">Select Position</option>
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
		  <textarea class="form-control" name='bio' aria-label="With textarea"></textarea>
		</div>
	

	<div>
		<input class="btn btn-primary" type="submit" value="Submit">
	</div>

	

</form>



@endsection