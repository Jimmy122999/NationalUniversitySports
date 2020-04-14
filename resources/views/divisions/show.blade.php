@extends ('layout')

@section ('content')
<div class = container>
  <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Games Played</th>
          <th scope="col">Wins</th>
          <th scope="col">Draws</th>
          <th scope="col">Losses</th>
          <th scope="col">Points</th>
        </tr>
      </thead>
      <tbody>

        @foreach ($teams as $team)
       <tr>
         <th scope="row"><a href="/teams/{{$team->id}}">{{$team->name}}</a></th>
         <td>{{$team->played}}</td>
         <td>{{$team->wins}}</td>
         <td>{{$team->draws}}</td>
         <td>{{$team->losses}}</td>
         <td>{{$team->points}}</td>


        
         
       </tr>

       @endforeach

      
    
       
      </tbody>
    </table>
    {{-- <form METHOD ="POST" action="/sports/{{$sport->name}}/{{$sport->division->id}}/season">
      @csrf --}}
    <a class="btn btn-primary" href="/sports/{{$sport->name}}/{{$division->id}}/season" role="button">Create New Post</a>
</div>
@endsection

