@extends('admin/layout')

@section('content')
<body>
	<div class="container">
<h1 class='title'>Enter Result</h1>

<form METHOD ="POST" action="/admin/fixtures/{{$fixture->id}}/result">
	@csrf
	

	<div>
			
		
		<div class="input-group mb-3">
		  <div class="input-group-prepend">
		    <span class="input-group-text" id="inputGroup-sizing-default">{{$fixture->homeTeam->name}} Score</span>
		  </div>
		  <input class="form-control" name='home_team_score' type="number">
		</div>

		<div class="input-group mb-5 dynamic">
			  <div class="input-group-prepend dynamic">
			    	<label class="input-group-text dynamic">Man of the Match</label>
			  </div>
				  <select class="custom-select dynamic" name='home_man_of_the_match'>
				  	
				  	@foreach ($fixture->homeTeam->member as $member)
				    <option value="{{$member->id}}" selected='true' disabled='disabled'>{{$member->name}}</option>
				   
				    @endforeach
				  </select>
		</div>
		
		<div class="input-group mb-3">
		  <div class="input-group-prepend">
		    <span class="input-group-text" id="inputGroup-sizing-default">{{$fixture->awayTeam->name}} Score</span>
		  </div>
		  <input class="form-control" name='away_team_score' type="number">
		</div>

		<div class="input-group mb-5 dynamic">
			  <div class="input-group-prepend dynamic">
			    	<label class="input-group-text dynamic">Man of the Match</label>
			  </div>
				  <select class="custom-select dynamic" name='away_man_of_the_match'>
				  	
				  	@foreach ($fixture->awayTeam->member as $member)
				    <option value="{{$member->id}}" selected='true' disabled='disabled'>{{$member->name}}</option>
				   
				    @endforeach
				  </select>
		</div>
		
		
		
		
		
	</div>


	

	<div>
		<input class="btn btn-primary" type="submit" value="Submit">
	</div>

	

</form>
@endsection