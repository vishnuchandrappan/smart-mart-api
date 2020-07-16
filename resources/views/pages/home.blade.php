@extends ('layouts.master')


@section ('main-content')
<div class="container-fluid heading color-1">
    DashBoard
</div>
<div class="container">
    <div class="list-group grid-1">

        <a class="list-group-item" href="/users">
            <span>Users</span>
        </a>

        <a class="list-group-item" href="/districts">
            <span>Districts</span>
        </a>

        <a class="list-group-item" href="/users">
            <span>Inventory</span>
        </a>

    </div>
</div>


@endsection
