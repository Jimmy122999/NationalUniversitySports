@extends ('layout')

@section('content')
<div class = container>
    <h1>Select a Team to Edit</h1>
<ul class="list-group">
 
  @foreach ($teams as $team)
  <div class="row">
    <div class="col-sm-9 mb-1">
  <li class ='list-group-item'>
    <a href='/teams/{{$team->id}}'>
        {{ $team->name }}</a>
      
  </li>

</div>
  <div class="col-sm-3">
  <a class="btn btn-primary ml-auto" href="/teams/{{ $team-> id}}/edit" role="button">Edit</a>
</div>
</div>

  @endforeach

  </ul>



 
</div>
@endsection
