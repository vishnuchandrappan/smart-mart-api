@extends ('layouts.master')


@section ('main-content')

<div class="container-fluid heading color-1">
    {{$district->name}}
</div>

<div class="container district-options">
    <div class="theaters">
        <h3>Super Markets</h3>
        @if(count($district->superMarkets) > 0)
        <div class="list-group">
            @foreach ($district->superMarkets as $superMarket)
            <div class="theater">
                <div class="list-group-item details">
                    <span>
                        {{$superMarket->name}}
                    </span>
                    <div class="btn-container">
                        <a href="/super-markets/{{$superMarket->id}}" class="btn btn-info">View</a>
                        <form class="d-inline p-0" action="/super-markets/{{$superMarket->id}}" method="POST">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="w-100">
            <a href="/districts/1/super-markets/new" class="btn btn-success float-right">Add New</a>
        </div>
        @else
        <div>No Super Markets Found !</div>
        <a href="/districts/{{$district->id}}/super-markets/new" class="btn btn-success">Add New</a>
        @endif
    </div>
</div>

@endsection
