@extends ('layout')

@section('content')

<div class="container">
    <div class="row justify-content py-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Teams</div>

                <div class="card-body">
                  	<a class="btn btn-success ml-auto" href="/teams/create" role="button">Add</a>
                    <a class="btn btn-primary ml-auto" href="/teams/index" role="button">Edit</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Fixtures</div>

                <div class="card-body">
                    <a class="btn btn-success ml-auto" href="/fixtures/create" role="button">Add</a>
                    <a class="btn btn-primary ml-auto" href="/fixtures/index" role="button">Edit</a>
                </div>
            </div>
        </div>
    </div>


    <div class="row justify-content">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Captains</div>

                <div class="card-body">
                    <a class="btn btn-success ml-auto" href="/captains/create" role="button">Add</a>
                    <a class="btn btn-danger ml-auto" href="/captains/index" role="button">Remove</a>
                   
                </div>
            </div>
        </div>
    </div>
</div>


@endsection