@extends('admin/layout')

@section('content')
	<div class="container">
<h1 class='title'>Create a new Post for {{$team->name}}</h1>

<form METHOD ="POST" action="/admin/teams/{{$team->id}}/{{$teamMember->id}}/post">
	@csrf
	

	<div>
		
		<div class="input-group mb-3">
		  <div class="input-group-prepend">
		    <span class="input-group-text" id="inputGroup-sizing-default">Post Title</span>
		  </div>
		  <input type="text" class="form-control" name='title'>
		</div>
		
		<input type="hidden" name="" class="input" value="" required>
	</div>

	<div class="input-group mb-3">
	  <div class="input-group-prepend">
	    <span class="input-group-text">Content</span>
	  </div>
	  <textarea class="form-control" name='body' aria-label="With textarea"></textarea>
	</div>
	

	<div>
		<input class="btn btn-primary" type="submit" value="Submit">
	</div>

	

</form>
@endsection