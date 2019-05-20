@extends('books.layout.layout')
    @section('content')     
        <br>
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item " aria-current="page"><a href="#">Panel Administratora</a></li>
                    <li class="breadcrumb-item active">Książki</li>
                </ol>
            </nav>
        @if(count($books) <= 0)
            <h1 class="text-center text-danger" style="font-size: 10rem;">Brak książek :(</h1>
        @else


        <table class="table table-striped table-dark table-bordered text-center align-middle">
            <thead class="thead-dark align-middle">
                <tr class="align-middle">
                <th class="align-middle" scope="col">ID</th>
                <th class="align-middle" scope="col">Okładka</th>
                <th class="align-middle" scope="col">Tytuł książki</th>
                <th class="align-middle" scope="col">Opis książki</th>
                <th class="align-middle" scope="col">Autor</th>
                <th class="align-middle" scope="col">Kategoria</th>
                <th class="align-middle" scope="col">Ilość polubień</th>
                <th class="align-middle" scope="col">Ilość nielubień</th>
                <th class="align-middle" scope="col">Edytuj</th>
                <th class="align-middle" scope="col">Usuń</th>
                </tr>
            </thead>
            <tbody class="align-middle" style="font-size: 150%;">
                @foreach($books as $book)
                    <tr class="align-middle">
                        <th class="align-middle" scope="row">{{$book->id}}</th>
                        <td class="align-middle"><img style="height: 10em" class="img-fluid" src="../uploads/{{$book->img}}" alt="Okładka książki pt. {{$book->title}}" /></td>

                        <td class="align-middle"><a href="{{ route('books.single', $book) }}">{{$book->title}}</</a></td>
                        <td class="align-middle">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#m{{$book->id}}">Zobacz opis</button>
                                <div class="modal fade" id="m{{$book->id}}" tabindex="-1" role="dialog" aria-labelledby="x{{$book->id}}" aria-hidden="true">
                                    <div class="modal-dialog modal-xl" role="document">
                                        <div  class="modal-content">
                                            <div  class="modal-header">
                                                <h5 class="modal-title" id="x{{$book->id}}">Opis książki pt. "{{$book->title}}".</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        <div class="modal-body text-dark">
                                            {!! $book->desc !!} 
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">{{$book->author->name}}</td>
                        <td class="align-middle">{{$book->categories->name}}</td>
                        <td class="align-middle">{{ count(DB::table('upvotes')->where('books_id', $book->id)->get()) }}</td>
                        <td class="align-middle">{{ count(DB::table('down_votes')->where('books_id', $book->id)->get()) }}</td>
                        <td class="align-middle"><a href="{{ route('books.edit', $book) }}" class="btn btn-success">Edytuj</a></td>
                        <td class="align-middle">
                        <form action="{{ route('books.destroy', $book) }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE" >
                            <button class="btn btn-danger">Usuń</button>
                        </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        @endif
            <nav class="mx-auto text-center" aria-label="Page navigation example">
                    {{$books->links('vendor.pagination.bootstrap-4')}}
            </nav>
        </div>
    @endsection
@section('scripts')
    
@endsection