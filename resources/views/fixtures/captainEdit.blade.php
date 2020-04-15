@extends('layout')

@section('content')
<body>
	<div class="container">
<h1 class='title mb-3'>Add Location and Information</h1>


<form METHOD ="POST" action="/fixtures/{{$fixture->id}}/captainEdit">
	@csrf
	@method('patch')
	



	<div class="card mb-3">


	    <div class="input-group mb-3 dynamic">
	    		 <div class="input-group-prepend dynamic" >
	    		    <label class="input-group-text dynamic" >Location/Info</label>
	    		 </div>
	    			 
	    		<textarea class="form-control" name='notes' aria-label="With textarea"></textarea>

	    </div>

	</div>

	<div class="row">
	<div class="col-sm-1"><input class="btn btn-primary" type="submit" value="Confirm"></div> 
	</form>



	



@endsection

