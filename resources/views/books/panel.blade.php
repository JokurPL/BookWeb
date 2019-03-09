@extends('books.layout.layout')
@section('content')
    <div class="container">
    <div style="margin: 1rem;" class="text-center">
        <h1>Panel Administratora</h1>
        <hr>
        <p style="font-size: 2rem">Witaj w panelu administratora, <b>{{ Auth::user()->name }}!</b></p>
        <p style="font-size: 2rem">Dzisiaj jest <i>{{ date('d.'.'m.'.'Y')}}r.</i></p>
        <hr>
        <h1 style="font-size: 4rem">Książki <a class="btn btn-primary btn-sm" href="{{ route('addbook') }}">Dodaj</a></h1>
        <hr>
    </div>

    <nav id="navbar-example2" class="navbar">
  <h1 class="navbar-brand" href="#">Panel</h1>
  <ul class="nav nav-pills">
    <li class="nav-item">
      <a class="nav-link" href="#fat">@fat</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#mdo">@mdo</a>
    </li>
  </ul>
</nav>
<div data-spy="scroll" data-target="#navbar-example2" data-offset="0">
  <h4 id="fat">Książki</h4>
  <p><a class="btn btn-lg">Zobacz wszystkie książki</a></p>
  <h4 id="mdo">@mdo</h4>
  <p>...</p>
  <h4 id="one">one</h4>
  <p>...</p>
  <h4 id="two">two</h4>
  <p>...</p>
  <h4 id="three">three</h4>
  <p>...</p>
</div>




    <div class="table-responsive">
    <table class="table table-inverse table-dark text-center table-striped table-bordered" id="tabelka">
        <thead>
        <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Tytuł</th>
            <th class="text-center">Opis</th>
            <th class="text-center">Autor</th>
            <th class="text-center">Kategoria</th>
            <th class="text-center">Plusy</th>
            <th class="text-center">Minusy</th>
            <th class="text-center">Edytuj</th>
            <th class="text-center">Usuń</th>
        </tr>
        </thead>
        <tbody>
        @foreach($books as $book)
        
            <tr>
                <th class="text-center">{{$book->id}}</th>
                <td><a href="{{ route('books.single', $book) }}">{{$book->title}}</a></td>
                <td class="text-dark"><!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#m{{$book->id}}">
  Zobacz opis
</button>

<!-- Modal -->
<div class="modal fade" id="m{{$book->id}}" tabindex="-1" role="dialog" aria-labelledby="x{{$book->id}}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="x{{$book->id}}">Opis książki pt. "{{$book->title}}".</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! $book->desc !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
      </div>
    </div>
  </div>
</div>
                </td>
                <td><a href="{{ route('books.author', $book->author->id) }}">{{ $book->author->name }}</a></td>
                <td><a href="{{ route('books.category', $book->categories->id) }}">{{$book->categories->name}}</a></td>
                <td>
                       
                            <strong>{{ count(DB::table('upvotes')->where('books_id', $book->id)->get()) }}</strong>
                        
                </td>
                <td>
                            <strong>{{ count(DB::table('down_votes')->where('books_id', $book->id)->get()) }}</strong>
                </td>
                <td><a href="{{ route('books.edit', $book) }}" class="btn btn-success">Edytuj</a></td>
                <form action="{{ route('books.destroy', $book) }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE" >
                    <td><button class="btn btn-danger">Usuń</button></td>
                </form>
            </tr>

        @endforeach
        </tbody>
    </table>
    </div>
        <nav class="mx-auto text-center"  aria-label="pagination">
            {{$books->links('vendor.pagination.bootstrap-4')}}
        </nav>
    <h1 style="font-size: 4rem" class="text-center">Kategorie <a class="btn btn-primary btn-sm" href="{{ route('books.cat_add') }}">Dodaj</a></h1>
    <hr>
    <div class="table-responsive">
    <table class="table table-dark table-inverse text-center table-striped table-bordered" id="tabelka">
        <thead>
         <tr>
             <th class="text-center">ID</th>
             <th class="text-center">Nazwa</th>
             <th class="text-center">Edytuj</th>
             <th class="text-center">Usuń</th>
         </tr>
        </thead>
        <tbody>
        @foreach($categories as $cat)
            <tr>
                <td>{{ $cat->id }}</td>
                <td>{{ $cat->name }}</td>
                <td><a href="{{ route('books.cat_edit', $cat) }}" class="btn btn-success">Edytuj</a></td>
                <form action="{{ route('books.cat_destroy', $cat) }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE" >
                    <td><button style="cursor: pointer;" class="btn btn-danger">Usuń</button></td>
                </form>
            </tr>
        @endforeach
        </tbody>
    </table></div>
        <nav class="mx-auto text-center"  aria-label="pagination">
            {{$categories->links('vendor.pagination.bootstrap-4')}}
        </nav>
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