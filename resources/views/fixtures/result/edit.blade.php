@extends('layout')

@section('content')
<body>
	<div class="container">
<h1 class='title'>Edit Result</h1>

<form METHOD ="POST" action="/fixtures/{{$fixtureResult->fixture->id}}/result/{{$fixtureResult->id}}">
	@csrf
	@method('patch')
	

	<div>
			
		
		<div class="input-group mb-3">
		  <div class="input-group-prepend">
		    <span class="input-group-text" id="inputGroup-sizing-default">{{$fixtureResult->fixture->homeTeam->name}} Score</span>
		  </div>
		  <input class="form-control" name='home_team_score' type="number">
		</div>

		<div class="input-group mb-5 dynamic">
			  <div class="input-group-prepend dynamic">
			    	<label class="input-group-text dynamic">Man of the Match</label>
			  </div>
				  <select class="custom-select dynamic" name='home_man_of_the_match'>
				  	
				  	@foreach ($fixtureResult->fixture->homeTeam->member as $member)
				    <option value="{{$member->id}}" selected='true' disabled='disabled'>{{$member->name}}</option>
				   
				    @endforeach
				  </select>
		</div>
		
		<div class="input-group mb-3">
		  <div class="input-group-prepend">
		    <span class="input-group-text" id="inputGroup-sizing-default">{{$fixtureResult->fixture->awayTeam->name}} Score</span>
		  </div>
		  <input class="form-control" name='away_team_score' type="number">
		</div>

		<div class="input-group mb-5 dynamic">
			  <div class="input-group-prepend dynamic">
			    	<label class="input-group-text dynamic">Man of the Match</label>
			  </div>
				  <select class="custom-select dynamic" name='away_man_of_the_match'>
				  	
				  	@foreach ($fixtureResult->fixture->awayTeam->member as $member)
				    <option value="{{$member->id}}" selected='true' disabled='disabled'>{{$member->name}}</option>
				   
				    @endforeach
				  </select>
		</div>
		
		
		
		
		
	</div>


	
<div class="row">
	<div class="col-sm-1">
		<input class="btn btn-primary" type="submit" value="Update">
	</div>
	</form>
	
	<form METHOD ="POST" action="/fixtures/{{$fixtureResult->fixture->id}}/result/{{$fixtureResult->id}}">
	  @csrf
	  @method('delete')
	<div class="col-sm-1"><a class="btn btn-danger" data-toggle="modal" data-target='#myModal' style="color: white">Delete</a></div>
	    
	     


	    <!-- Modal -->
	    <div id="myModal" class="modal fade" role="dialog">
	      <div class="modal-dialog modal-dialog-centered">

	        <!-- Modal content-->
	        <div class="modal-content">
	          <div class="modal-body">
	            <p>Are you sure you want to delete this Result?</p>
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