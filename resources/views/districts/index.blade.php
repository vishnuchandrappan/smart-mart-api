@extends ('layouts.master')


@section ('main-content')
@if(count($districts) > 0)
<div class="container-fluid heading color-1">
    Districts
</div>
<div class="container">
    @foreach ($districts as $district)
    <a class="list-group" href="/districts/{{$district->id}}">
        <span class="list-group-item">{{$district->name}}</span>
    </a>
    @endforeach
    <a href="/districts/new" class="btn btn-success float-right">Add New</a>
</div>
@else
<div class="full-page">
    <span>No Districts Found !</span>
    <a href="/districts/new">Create New District</a>
</div>
@endif


@endsection
