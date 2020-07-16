@extends ('layouts.master')


@section ('main-content')
@if(count($labels) > 0)
<div class="container-fluid heading color-1">
    Districts
</div>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-warning">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/inventory">Inventory</a></li>
            <li class="breadcrumb-item active" aria-current="page">Labels</li>
        </ol>
    </nav>
    <div class="list-group grid-1">

        @foreach ($labels as $label)
        <div class="list-group-item flex-1 flex-2">
            <span>{{$label->name}}</span>
            <div class="btn-container w-100">
                <a href="/labels/{{$label->id}}/edit" class="btn btn-info">Edit</a>
                <form action="/labels/{{$label->id}}" method="POST" class="d-inline">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Delete" class="btn btn-danger">
                </form>
            </div>
        </div>
        @endforeach
    </div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-warning float-right" data-toggle="modal" data-target="#newLabel">
        Create New Label
    </button>

</div>
@else
<div class="full-page">
    <span>No Labels Found !</span>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#newLabel">
        Create New Label
    </button>

</div>
@endif


<!-- Modal -->
<div class="modal fade" id="newLabel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/labels" class="login" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create New Label</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf

                    <div class="form-group">
                        <label>Label</label>
                        <input type="text" name="label_name" class="form-control">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Create !</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
