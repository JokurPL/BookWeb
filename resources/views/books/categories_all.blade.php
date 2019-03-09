@extends('books.layout.layout')
@section('content')
    <div class="container">
        <br>
        <nav class="navbar navbar-light bg-light">
        <h1>Wszystkie kategorie:</h1>
        <form class="form-inline" method="get" action="{{ route('books.cats_find') }}">
            <input class="form-control mr-sm-2" name="query" type="search" placeholder="Szukaj kategorii..." aria-label="Search">
            <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Szukaj</button>
        </form>
        </nav>
        <hr>
        <ul class="list-group ">
        @foreach($cats as $value)
        <a href="{{ route('books.category', $value->id) }}"><li class="list-group-item">{{$value->name}}</li></a><br>
        @endforeach
        </ul>
        <nav class="mx-auto text-center" aria-label="Page navigation example">
                {{$cats->links('vendor.pagination.bootstrap-4')}}
        </nav>
    </div>
@endsection