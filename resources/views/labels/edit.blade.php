@extends ('layouts.master')


@section ('main-content')
<div class="container-fluid heading color-1">
    Edit Layout
</div>
<div class="container">
    <form action="/labels/{{$label->id}}" method="POST" class="jumbotron">
        @csrf
        @method('put')

        <div class="form-group">
            <label>Label</label>
            <input type="text" name="label_name" value="{{$label->name}}" class="form-control">
        </div>

        <div class="btn-container">
            <button type="submit" class="btn btn-danger">Save Changes</button>
        </div>
    </form>
</div>


@endsection
