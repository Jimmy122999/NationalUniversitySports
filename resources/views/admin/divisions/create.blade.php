@extends('admin/layout')

@section('content')
<body>
	<div class="container">
<h1 class='title'>Create a new Division</h1>

<form METHOD ="POST" action="/admin/sports/{{$sport->id}}">
	@csrf
	

	<div>
		<input type="text" name="name" placeholder="Name" class="input" required>
		<input type="hidden" name="sportID" class="input" value="{{$sport->id}}" required>
	</div>
	

	<div>
		<input class="btn btn-primary" type="submit" value="Submit">
	</div>

	

</form>
@endsection