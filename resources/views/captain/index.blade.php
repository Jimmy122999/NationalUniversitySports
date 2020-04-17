@extends ('layout')

@section('content')
<div class = container>
    <h1>Select a Captain to remove</h1>
<ul class="list-group">
 
  @foreach ($users as $captain)
  <div class="row">
    <div class="col-sm-9 mb-1">
  <li class ='list-group-item'>
   
        {{ $captain->name }}
      
  </li>

</div>
  <div class="col-sm-3">
    <form METHOD ="POST" action="/captains/edit/{{$captain->id}}">
          @csrf
          @method('patch')
          <input class="btn btn-danger" type="submit" value="Remove">
    </form>
</div>
</div>

  @endforeach

  </ul>



 
</div>
@endsection
