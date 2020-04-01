@extends ('admin/layout')

@section('content')

<div class="container">
    <div class="row justify-content py-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Teams</div>

                <div class="card-body">
                  	<a class="btn btn-success ml-auto" href="/admin/teams/create" role="button">Add</a>
                    <a class="btn btn-primary ml-auto" href="/admin/teams/index" role="button">Edit</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Fixtures</div>

                <div class="card-body">
                    <a class="btn btn-success ml-auto" href="/admin/fixtures/create" role="button">Add</a>
                    <a class="btn btn-primary ml-auto" href="/admin/fixtures/index" role="button">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection