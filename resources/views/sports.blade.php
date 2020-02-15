@extends ('layout')

@section ('content')
<div class = container>
	<h1>Select a sport to view the league table for it</h1>
<ul class="list-group">
  <li class="list-group-item"><a class="nav-link" href="/football">Football</a></li>
  <li class="list-group-item"><a class="nav-link" href="/lacrosse">Lacrosse</a></li>
  <li class="list-group-item">Rugby</li>
  </ul>
</div>
@endsection