@extends('admin/layout')

@section('content')
<body>
	<div class="container">
<h1 class='title'>Create a new Division</h1>

<form METHOD ="POST" action="/admin/sports/{{$sport->id}}">
	@csrf
	

	<div>
		
		<div class="input-group mb-3">
		  <div class="input-group-prepend">
		    <span class="input-group-text" id="inputGroup-sizing-default">Division Name</span>
		  </div>
		  <input type="text" class="form-control" name='name'>
		</div>
		
		<input type="hidden" name="sportID" class="input" value="{{$sport->id}}" required>
	</div>
	

	<div>
		<input class="btn btn-primary" type="submit" value="Submit">
	</div>

	

</form>
@endsection