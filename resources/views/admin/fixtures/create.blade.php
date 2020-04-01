@extends('admin/layout')

@section('content')
<body>
	<div class="container">
<h1 class='title mb-3'>Create a Fixture</h1>


<form METHOD ="POST" action="/admin/fixtures/create">
	@csrf
	

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
	    			  
	    			 </select>

	    </div>

	    <div class="input-group mb-3 dynamic">
	    		 <div class="input-group-prepend dynamic" >
	    		    <label class="input-group-text dynamic" >Away Team</label>
	    		 </div>
	    			 
	    			<select class="custom-select dynamic" name='awayTeam' id='awayTeam' data-dependent='division'>
	    			  
	    			</select>

	    </div>
	  </div>
	</div>

	<div class="card">
	  <div class="card-body">
	  	<h1>Information</h1>
	    <div class="input-group mb-3 dynamic">
	    		 <div class="input-group-prepend dynamic" >
	    		    <label class="input-group-text dynamic" >Date & Time</label>
	    		 </div>
	    			  <input type="datetime-local" name='time'>
	    			
	    			  
	    			

	    </div>

	    <div class="input-group mb-3 dynamic">
	    		 <div class="input-group-prepend dynamic" >
	    		    <label class="input-group-text dynamic" >Information</label>
	    		 </div>
	    			 
	    		<textarea class="form-control" name='notes' aria-label="With textarea"></textarea>

	    </div>
	  </div>
	</div>

	<div class="col-sm-1"><input class="btn btn-primary" type="submit" value="Create"></div>



	




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