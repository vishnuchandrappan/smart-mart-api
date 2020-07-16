@extends ('layouts.master')


@section ('main-content')

<div class="container-fluid heading color-1">
    {{$superMarket->district->name}}
</div>

<div class="container">
    <table class="theaters table table-striped">
        <tr>
            <th scope="col">Name</th>
            <td>{{$superMarket->name}}</td>
        </tr>
        <tr>
            <th scope="col">Address</th>
            <td>{{$superMarket->address}}</td>
        </tr>
        <tr>
            <th scope="row">Contact</th>
            <td>{{$superMarket->phone_number}}</td>
        </tr>
        <tr>
            <th scope="row">Admin</th>
            <td>{{$superMarket->user->name}}</td>
        </tr>
    </table>
    <div>
        <iframe src="{{$superMarket->location}}" frameborder="0" style="border:0;" allowfullscreen="true"
            aria-hidden="false" tabindex="0"></iframe>
    </div>
</div>

@endsection
