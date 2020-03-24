@extends('admin/layout')

@section('content')
<body>
	<div class="container">
<h1 class='title'>Create a new Team</h1>


<form METHOD ="POST" action="/admin/teams/create/">
	@csrf
	

	<div class="input-group mb-3">
	  <div class="input-group-prepend">
	    <span class="input-group-text" id="inputGroup-sizing-default">Team Name</span>
	  </div>
	  <input type="text" class="form-control" name='name'>
	</div>

	<div class="input-group mb-3 dynamic">
		  <div class="input-group-prepend dynamic">
		    	<label class="input-group-text dynamic">Sport</label>
		  </div>
			  <select class="custom-select dynamic" id='sport' name='sport' data-dependent='division'>

			  	@foreach ($sports as $sport)
			    
			    <option value="{{$sport->id}}" name='sport'>{{$sport->name}}</option>
			    @endforeach
			  </select>
	</div>

	<div class="input-group mb-3 dynamic">
			  <div class="input-group-prepend dynamic" >
			    	<label class="input-group-text dynamic" >Division</label>
			  </div>
				  <select class="custom-select dynamic" name='division' id='division' data-dependent='sport'>
				  
				 	
				  	
					
				  </select>

			</div>
			<input class="btn btn-primary" type="submit" value="Submit">
		</div>

	

	

	<div>
		
	</div>

	

</form>
@endsection
</html>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){

	$('#sport').change(function(){


		if($(this).val() != ''){
			var select =$(this).attr('id');
			var value =$(this).val();
			var dependent = $(this).data('dependent');
			var _token = $('input[name="_token"]').val();


			$.ajax({
				url:"{{ route('dynamicdependent.fetch')}}",
				method:"POST",
				data:{
					select:select, 
					value:value, 
					_token: _token, 
					dependent:dependent
				},
				success:function(result)
				{
					$('#'+dependent).html(result);
				}
			})

		}

	});

});


</script>

@push('scripts')