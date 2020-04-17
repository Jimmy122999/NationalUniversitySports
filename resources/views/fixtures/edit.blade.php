@extends('layout')

@section('content')
<body>
	<div class="container">
<h1 class='title mb-3'>Edit a Fixture</h1>


<form METHOD ="POST" action="/fixtures/{{$fixture->id}}/edit">
	@csrf
	@method('patch')
	

	<div class="card mb-3">
	  <div class="card-body">
	    <h1>Sport And Division</h1>
	    <div class="input-group mb-3 dynamic">
	    	  <div class="input-group-prepend dynamic">
	    	    	<label class="input-group-text dynamic">Sport</label>
	    	  </div>
	    		  <select class="custom-select dynamic" id='sport_id' name='sport_id' data-dependent='id'>
	    		  	<option value="#" selected='true' disabled='disabled'>Select a Sport</option>
	    		  	@foreach($sports as $sport)
	    		    
	    		    <option value="{{$sport->id}}" name='sport'>{{$sport->name}}</option>
	    		    @endforeach
	    		    
	    		  </select>
	    </div>

	    <div class="input-group mb-3 dynamic">
	    		  <div class="input-group-prepend dynamic" >
	    		    	<label class="input-group-text dynamic" >Division</label>
	    		  </div>
	    			  <select class="custom-select dynamic" name='division_id' id='division_id' data-dependent='team_id'>
	    			  
	    			 	
	    			  	
	    				
	    			  </select>

	    </div>
	  </div>
	</div>
	

	<div class="card mb-3">
	  <div class="card-body">
	  	<h1>Teams</h1>
	    <div class="input-group mb-3 dynamic">
	    		 <div class="input-group-prepend dynamic" >
	    		    <label class="input-group-text dynamic" >Home Team</label>
	    		 </div>
	    			  
	    			 <select class="custom-select dynamic" name='homeTeam' id='homeTeam' data-dependent='division'>
	    			  <option value="{{$fixture->homeTeam->id}}" selected='{{$fixture->homeTeam->id}}'>{{$fixture->homeTeam->name}}</option>
	    			 </select>

	    </div>

	    <div class="input-group mb-3 dynamic">
	    		 <div class="input-group-prepend dynamic" >
	    		    <label class="input-group-text dynamic" >Away Team</label>
	    		 </div>
	    			 
	    			<select class="custom-select dynamic" name='awayTeam' id='awayTeam' data-dependent='division'>
	    				<option value="{{$fixture->awayTeam->id}}" selected='{{$fixture->awayTeam->id}}'>{{$fixture->awayTeam->name}}</option>
	    			  
	    			</select>

	    </div>
	  </div>
	</div>

	<div class="card mb-3">
	  <div class="card-body">
	  	<h1>Information</h1>
	    <div class="input-group mb-3 dynamic">
	    		 <div class="input-group-prepend dynamic" >
	    		    <label class="input-group-text dynamic" >Date & Time</label>
	    		 </div>
	    			  <input type="date" name='date'>
	    			  <input type="time" name='time'>
	    			
	    			  
	    			

	    </div>

	    <div class="input-group mb-3 dynamic">
	    		 <div class="input-group-prepend dynamic" >
	    		    <label class="input-group-text dynamic" >Information</label>
	    		 </div>
	    			 
	    		<textarea class="form-control" name='notes' aria-label="With textarea"></textarea>

	    </div>
	  </div>
	</div>
	<div class="row">
	<div class="col-sm-1"><input class="btn btn-primary" type="submit" value="Confirm"></div> 
	</form>
	<form METHOD ="POST" action="/fixtures/{{$fixture->id}}">
	  @csrf
	  @method('delete')
	<div class="col-sm-1"><a class="btn btn-danger" data-toggle="modal" data-target='#myModal' style="color: white">Delete</a></div>
	    
	     


	    <!-- Modal -->
	    <div id="myModal" class="modal fade" role="dialog">
	      <div class="modal-dialog modal-dialog-centered">

	        <!-- Modal content-->
	        <div class="modal-content">
	          <div class="modal-body">
	            <p>Are you sure you want to delete this Fixture?</p>
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




	




	</div>



	



@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){

	$('#sport_id').change(function(){


		if($(this).val() != ''){
			var select =$(this).attr('id');
			var value =$(this).val();
			var dependent = $(this).data('dependent');
			var _token = $('input[name="_token"]').val();
			$.ajax({
				url:"{{ route('teamcontroller.fetch')}}",
				method:"POST",
				data:{
					select:select, 
					value:value, 
					_token: _token, 
					dependent:dependent
				},
				success:function(result)
				{
					$('#division_id').html(result);
				}
			})

		}

	});

});
</script>

<script type="text/javascript">
$(document).ready(function(){

	$('#division_id').change(function(){


		if($(this).val() != ''){
			var select =$(this).attr('id');
			var value =$(this).val();
			var dependent = $(this).data('dependent');
			var _token = $('input[name="_token"]').val();
			$.ajax({
				url:"{{ route('teamcontroller.teamfetch')}}",
				method:"POST",
				data:{
					select:select, 
					value:value, 
					_token: _token, 
					dependent:dependent
				},
				success:function(result)
				{
					$('#homeTeam').html(result);
					$('#awayTeam').html(result);
				}
			})

		}

	});

});
</script>