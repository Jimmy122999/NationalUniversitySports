@extends('admin/layout')

@section('content')
<body>
	<div class="container">
<h1 class='title'>Create a new Team</h1>

@foreach ($captains as $captain)

{{$captain->name}}

@endforeach


<form METHOD ="POST" action="/admin/sports">
	@csrf
	

	<div class="input-group mb-3">
	  <div class="input-group-prepend">
	    <span class="input-group-text" id="inputGroup-sizing-default">Team Name</span>
	  </div>
	  <input type="text" class="form-control" name='name'>
	</div>

	<div class="input-group mb-3">
		  <div class="input-group-prepend">
		    	<label class="input-group-text" for="inputGroupSelect01">Sport</label>
		  </div>
			  <select class="custom-select">

			  	@foreach ($sports as $sport)
			    
			    <option value="{{$sport->id}}" name='sport'>{{$sport->name}}</option>
			    @endforeach
			  </select>
	</div>


	

	<div>
		<input class="btn btn-primary" type="submit" value="Submit">
	</div>

	

</form>
@endsection