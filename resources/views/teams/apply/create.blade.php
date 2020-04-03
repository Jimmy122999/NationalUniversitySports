@extends('layout')

@section('content')
<body>
	<div class="container">
<h1 class='title'>Apply to join {{$team->name}}</h1>


<form METHOD ="POST" action="/teams/{{$team->id}}/apply">
	@csrf
	

	<div class="input-group mb-3">
	  <div class="input-group-prepend">
	    <span class="input-group-text" id="inputGroup-sizing-default">Display Name</span>
	  </div>
	  	<input type="text" class="form-control" name='name'>
	</div>

	<div>
		<input class="btn btn-primary" type="submit" value="Submit">
	</div>

	

</form>
@endsection
</html>