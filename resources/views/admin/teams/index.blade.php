@extends ('admin/layout')

@section('content')

<div class="container">
    <div class="row justify-content">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add New Team</div>

                <div class="card-body">
                    <a class="btn btn-primary ml-auto" href="/admin/teams/create" role="button">Add</a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
