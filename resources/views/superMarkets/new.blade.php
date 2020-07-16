@extends ('layouts.master')


@section ('main-content')

<div class="container-fluid heading color-1">
    {{$district->name}}
    <div class="small">
        Create New Super Market
    </div>
</div>

<div class="container">
    <form class="login" action="/districts/{{$district->id}}/super-markets" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Name</label>
            <input type="text" name="name" required class="form-control">
        </div>

        <div class="form-group">
            <label for="email">Address</label>
            <textarea name="address" class="form-control" rows="4"></textarea>
        </div>

        <div class="form-group">
            <label for="phone">Contact</label>
            <input type="number" name="phone_number" required class="form-control">
        </div>

        <div class="form-group">
            <label for="email">Location</label>
            <input type="text" name="location" class="form-control">
        </div>

        <div class="form-group">
            <label for="email">User</label>
            <select name="user_id" class="form-control">
                @foreach ($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="btn-container">
            <button type="submit" class="btn btn-info">Create New !</button>
        </div>

    </form>
</div>
{{--
<div class="navigation btn-container">
    <button class="btn btn-warning" onclick="goBack()"> &lt;&lt; back</button>
</div> --}}

@endsection
