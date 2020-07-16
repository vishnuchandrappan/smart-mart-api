@extends ('layouts.master')


@section ('main-content')
<div class="container-fluid heading color-1">
    DashBoard
</div>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-warning">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Inventory</li>
        </ol>
    </nav>
    <div class="list-group grid-1">

        <a class="list-group-item" href="/labels">
            <span>Label Management</span>
        </a>

        <a class="list-group-item" href="/items">
            <span>Item Management</span>
        </a>

        <a class="list-group-item" href="/sales">
            <span>Sales</span>
        </a>

    </div>
</div>


@endsection
