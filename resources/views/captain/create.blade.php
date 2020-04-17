@extends ('layout')

@section('content')
<div class = container>
    <h1>Select a Player to make a Captain</h1>
<ul class="list-group">
 
  @foreach ($users as $player)
  <div class="row">
    <div class="col-sm-9 mb-1">
  <li class ='list-group-item'>
   
        {{ $player->name }}
      
  </li>

</div>
  <div class="col-sm-3">
    <form METHOD ="POST" action="/captains/{{$player->id}}">
          @csrf
          @method('patch')
          <input class="btn btn-success" type="submit" value="Make Captain">
    </form>
</div>
</div>

  @endforeach

  </ul>



 
</div>
@endsection
