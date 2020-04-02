@extends ('admin/layout')

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

        @foreach ($division->team as $team)
       <tr>
         <th scope="row"><a href="/admin/teams/{{$team->id}}">{{$team->name}}</a></th>
         <td>{{$team->played}}</td>
         <td>{{$team->wins}}</td>
         <td>{{$team->draws}}</td>
         <td>{{$team->losses}}</td>
         <td>{{$team->points}}</td>


        
         
       </tr>

       @endforeach


    
       
      </tbody>
    </table>
</div>
@endsection

