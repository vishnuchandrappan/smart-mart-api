@extends ('layouts.master')

@section ('main-content')
<div class="container-fluid heading color-1">
    Add New District
</div>
<div class="container">
    <form class="login" action="/districts/{{$district->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="email">Name</label>
            <input type="text" name="name" value="{{$district->name}}" placeholder="Eg: Alappuzha" required
                class="form-control">
        </div>

        <div class="btn-container">
            <button type="submit" class="btn btn-info">Save Changes</button>
        </div>

    </form>
</div>

@endsection
