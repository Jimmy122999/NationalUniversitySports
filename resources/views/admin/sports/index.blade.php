@extends ('admin/layout')

@section ('content')
<div class = container>
	<h1>Select a sport to view the league table for it</h1>
<ul class="list-group">
 
  @foreach ($sports as $sport)
  <div class="row">
  	<div class="col">
  <li class ='list-group-item'>
  	<a href='/admin/sports/{{$sport->id}}'>
  		{{ $sport->name }}</a>

  </li>
</div>
</div>

  @endforeach

  </ul>



  <a class="btn btn-primary" href="/admin/sports/create" role="button">Create new sport</a>
</div>
@endsection


