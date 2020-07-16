@extends ('layouts.master')


@section ('main-content')
<div class="container-fluid heading color-1">
    Users
</div>
<div class="container">
    <div class="list-group grid-1">

        @foreach ($users as $user)
        <div class="list-group-item user">
            <div class="user-details">
                <h3>{{$user->name}}</h3>
                <span>{{$user->email}}</span>
            </div>
            @if ($user->user_type !== '1')
            <div class="user-options">
                <form action="/users/{{$user->id}}" method="POST" style="display: inline">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </div>
            @else
            <div class="user-options bg-danger p-3 text-light">
                Admin
            </div>
            @endif
        </div>
        @endforeach

    </div>
</div>


@endsection
