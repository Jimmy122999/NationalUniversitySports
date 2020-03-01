@extends('admin/layout')

@section('content')
<body>
	<div class="container">
<h1 class='title'>Create a new Sport</h1>

<form METHOD ="POST" action="/admin/sports/store">
	@csrf
	

	<div>
		<input type="text" name="name" placeholder="Name" class="input" required>
	</div>
	

	<div>
		<input class="btn btn-primary" type="submit" value="Submit">
	</div>

	<btn

</form>
@endsection