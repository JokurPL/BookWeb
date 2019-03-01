@extends('books.layout.layout')
    @section('content')
        {{--<div class="container">--}}
        {{--<h1 class="text-center" style="margin: 1rem;">Popularne książki</h1>--}}
        {{--<hr>--}}
        {{--</div>--}}
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active"  >
                <img src="https://i.imgur.com/KXt6u8i.png" class="d-block w-100"   alt="...">
                </div>
                <div class="carousel-item">
                <img src="https://i.imgur.com/jk88jJ7.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                <img src="https://i.imgur.com/QxHKLlu.png" class="d-block w-100" alt="...">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="container">
        @if(count($books) <= 0)
            <h1 class="text-center text-danger" style="font-size: 10rem;">Brak książek :(</h1>
        @else
        <div class="row mx-auto">
            @foreach($books as $book)
            <div class="card float-left mx-auto post" style="width: 20rem; margin: 1rem;">
                <img class="card-img img-fluid" src="../uploads/{{$book->img}}" alt="{{$book->img}}">
                <div class="card-body text-center">
                    <h4 class="card-title ">{{$book->title}}</h4><a href="{{route('books.category', $book->categories->id)}}" class="btn btn-outline-info">{{$book->categories->name}}</a> <a href="{{ route('books.author', $book->author->id) }}"  class="btn btn-outline-secondary" style="margin: 2%;">{{$book->author->name}}</a>
                    </p>
                    <a href="{{ route('books.single', $book) }}" class="btn btn-primary">Szczegóły</a>
                </div>
            </div>
                    @endforeach
        </div>
        @endif
        <nav class="mx-auto text-center" aria-label="Page navigation example">
                {{$books->links('vendor.pagination.bootstrap-4')}}
            </nav>
        </div>
    @endsection
@section('scripts')
    <script>
        $('.carousel').carousel()
    </script>
    @endsection