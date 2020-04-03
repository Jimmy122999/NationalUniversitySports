@extends ('layout')

@section ('content')
<div class = container>
	<h1>Select a sport to view the league table for it</h1>
<ul class="list-group">
 
  @foreach ($sports as $sport)
  <div class="row">
  	<div class="col-sm-9 mb-1">
  <li class ='list-group-item'>
  	<a href='/sports/{{$sport->name}}'>
  		{{ $sport->name }}</a>
      
  </li>

</div>
  @can('create' , App\Sport::class)
  <div class="col-sm-3">
  <a class="btn btn-primary ml-auto" href="/sports/{{ $sport-> name}}/edit" role="button">Edit</a>
  </div>
  @endcan
</div>

  @endforeach

  </ul>


  @can('create' , App\Sport::class)
  <a class="btn btn-primary" href="/sports/create" role="button">Create new sport</a>
  @endcan
</div>
@endsection


