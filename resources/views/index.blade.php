@extends('layout')

@section('content')

<div id="header-wrapper">
	
	<div id="header-featured">
		<div id="banner-wrapper">
			
	</div>
</div>
<div id="wrapper">
	<div id="page" class="container">
		@guest
		<div class="jumbotron">
		  <h1 class="display-4">Welcome to National University Sports</h1>
		  <p class="lead">This is an application that is used to track the performance of university teams playing eachother across a season</p>
		  <hr class="my-4">
		  <p>There is also builty in social tools for teams to communicate messages and even for players to have their own profiles</p>
		  <p class="lead">
		    <a class="btn btn-primary btn-lg" href="/register" role="button">Get Started</a>
		  </p>
		</div>
		@else
		<div class="jumbotron">
		  <h1 class="display-4">Welcome to Natasdasdasdasdional University Sports</h1>
		  <p class="lead">This is an application that is used to track the performance of university teams playing eachother across a season</p>
		  <hr class="my-4">
		  <p>There is also builty in social tools for teams to communicate messages and even for players to have their own profiles</p>
		  <p class="lead">
		    <a class="btn btn-primary btn-lg" href="/register" role="button">Get Started</a>
		  </p>
		</div>
		@endguest

	</div>
</div>

@endsection