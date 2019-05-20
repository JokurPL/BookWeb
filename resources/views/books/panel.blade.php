@extends('books.layout.layout')
@section('content')
    <div class="container">
    <div style="margin: 1rem;" class="text-center">
        <h1>Panel Administratora</h1>
        <hr>
        <p style="font-size: 2rem">Witaj w panelu administratora, <b>{{ Auth::user()->name }}!</b></p>
        <p style="font-size: 2rem">Dzisiaj jest <i>{{ date('d.'.'m.'.'Y')}}r.</i></p>
        <hr>


<div class="list-group">
<a href="{{ route('books.panel_books')}}" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Książki</h5>
      <small class="text-muted">Ilość książek: <strong>{{ count($books) }}</strong></small>
    </div>
    <p class="mb-1">Tutaj możesz zobaczyć, zedytować oraz usunąć wszystkie książki.</p>
    <small class="text-muted"><b>Kliknij, aby przejść</b></small>
  </a>
</div>

    <h1 style="font-size: 4rem" class="text-center">Autorzy <a class="btn btn-primary btn-sm" href="{{ route('books.author_add') }}">Dodaj</a></h1>
    <hr>
    <div class="table-responsive">
    <table class="table table-dark table-inverse text-center table-striped table-bordered" id="tabelka">
        <thead>
        <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Imię i nazwisko</th>
            <th class="text-center">Edytuj</th>
            <th class="text-center">Usuń</th>
        </tr>
        </thead>
        <tbody>
        @foreach($author as $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->name }}</td>
                <td><a href="{{ route('books.author_edit', $value) }}" class="btn btn-success">Edytuj</a></td>
                <form action="{{ route('books.author_destroy', $value) }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE" >
                    <td><button style="cursor: pointer;" class="btn btn-danger">Usuń</button></td>
                </form>
            </tr>
        @endforeach
        </tbody>
    </table></div>
        <nav class="mx-auto text-center"  aria-label="pagination">
            {{$author->links('vendor.pagination.bootstrap-4')}}
        </nav>
        <h1 style="font-size: 4rem" class="text-center">Komentarze</h1>
        <hr>
        <div class="table-responsive">
        <table class="table table-dark table-inverse text-center table-striped table-bordered" id="tabelka">
            <thead>
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Autor</th>
                <th class="text-center">Treść</th>
                <th class="text-center">Usuń</th>
            </tr>
            </thead>
            <tbody>
            @foreach($comments as $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td><a href="{{ route('books.user', $value->user)}}">{{ $value->user->name }}</a></td>
                    <td>{{ $value->comment }}</td>
                    <form action="{{ route('books.com_destroy', $value) }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE" >
                        <td><button style="cursor: pointer;" class="btn btn-danger">Usuń</button></td>
                    </form>
                </tr>
            @endforeach

            </tbody>

        </table></div>
        <nav class="mx-auto text-center"  aria-label="pagination">
            {{$comments->links('vendor.pagination.bootstrap-4')}}
        </nav>
    </div>
@endsection