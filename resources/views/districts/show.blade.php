@extends ('layouts.master')


@section ('main-content')

<div class="container-fluid heading color-1">
    {{$district->name}}
</div>

<div class="container district-options">
    <div class="theaters">
        <h3>Theaters</h3>
        @if(count($district->theaters) > 0)
        <div class="list-group">
            @foreach ($district->theaters()->with('selectedMovies')->get() as $theater)
            <div class="theater">
                <div class="list-group-item details">
                    <span>
                        {{$theater->name}}
                    </span>
                    <div class="btn-container">
                        <a href="/theaters/{{$theater->id}}" class="btn btn-info">View</a>
                        <a href="/theaters/{{$theater->id}}/edit" class="btn btn-info">Edit</a>
                        <a href="/theaters/{{$theater->id}}/delete" class="btn btn-danger">Delete</a>
                    </div>
                </div>
                @if(count($theater->movies) > 0)
                <h4>Movies</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Director</th>
                            <th scope="col">Release Date</th>
                            <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($theater->movies->take(3) as $movie)
                        <tr>
                            <th scope="row">{{$movie->id}}</th>
                            <td>{{$movie->name}}</td>
                            <td>{{$movie->director}}</td>
                            <td>{{$movie->release_date}}</td>
                            <td>
                                <a href="/movies/{{$movie->id}}" class="btn btn-warning">
                                    View
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if(count($theater->movies) === 3)
                <div>
                    <a href="#" class="btn btn-warning float-right">View More</a>
                </div>
                @endif
                @endif
            </div>
            @endforeach
        </div>
        <div class="w-100">
            <a href="/districts/1/theaters/new" class="btn btn-success float-right">Add New</a>
        </div>
        @else
        <div>No Theaters Found !</div>
        <a href="/districts/{{$district->id}}/theaters/new" class="btn btn-success">Add New</a>
        @endif
    </div>
</div>

<div class="navigation btn-container">
    <button class="btn btn-warning" onclick="goBack()"> &lt;&lt; back</button>
</div>

@endsection
