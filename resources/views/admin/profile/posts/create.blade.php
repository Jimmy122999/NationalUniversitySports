@extends('admin/layout')

@section('content')
	<div class="container">
<h1 class='title'>Create a new Post for {{$userProfile->member->name}}</h1>

<form METHOD ="POST" action="/admin/profile/{{$userProfile->id}}/post/create">
	@csrf
	

	

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