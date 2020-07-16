@extends ('layouts.master')


@section ('main-content')
@if(count($districts) > 0)
<div class="container-fluid heading color-1">
    Districts
</div>
<div class="container">
    <div class="list-group grid-1">

        @foreach ($districts as $district)
        <div class="list-group-item flex-1">
            <span>{{$district->name}}</span>
            <div class="buttons">
                <a href="/districts/{{$district->id}}" class="btn btn-success">View</a>
                <a href="/districts/{{$district->id}}/edit" class="btn btn-warning">Edit</a>
                <form action="/districts/{{$district->id}}" method="POST" class="d-inline">
                    @csrf
                    @method('delete')
                    <input type="submit" value="DELETE" class="btn btn-info">
                </form>
            </div>
        </div>
        @endforeach
    </div>
    <a href="/districts/new" class="btn btn-success float-right">Add New</a>
</div>
@else
<div class="full-page">
    <span>No Districts Found !</span>
    <a href="/districts/new">Create New District</a>
</div>
@endif


@endsection
