@extends('books.layout.layout')
@section('content')
    <div class="container">
    @foreach($cat as $c)
        <p>
            <h1>Autor: <u><i class="text-primary ">{{$c->name}}</i></u></h1>
            <hr>
        </p>
    @endforeach
    <div class="row mx-auto">
    @if(count($books) <= 0)
    <div class="card text-center mx-auto">
        <div class="card-body">
            <h3>Brak książek autorstwa ww. autora.</h3>
            <a href="{{ route('home') }}">Powrót do strony głównej</a>
        </div>
    </div>
    @else
    @foreach($books as $book)

        <div class="card float-left mx-auto post" style="width: 20rem; margin: 1rem;">
            <img class="card-img" width="50px" src="../uploads/{{$book->img}}" alt="Card image cap">
            <div class="card-body text-center">
                <h4 class="card-title ">{{$book->title}}</h4><a href="{{route('books.category', $book->categories->id)}}" class="btn btn-outline-info">{{$book->categories->name}}</a> <a href="{{ route('books.author', $book->author->id) }}"  class="btn btn-outline-secondary" style="margin: 2%;">{{$book->author->name}}</a>
                </p>
                <a href="{{ route('books.single', $book) }}" class="btn btn-primary">Szczegóły</a>
            </div>
        </div>

    @endforeach
    @endif
    </div></div>
@endsection