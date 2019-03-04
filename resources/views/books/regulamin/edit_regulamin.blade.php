@extends('books.layout.layout')
@section('content')
    <div class="container">
    @foreach($content as $value)
        <form method="post" action="{{ route('books.save_edit_regulamin') }}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id" value="{{$value->id}}">
            <div class="form-group">
                <br>
                <label for="content"><h1>Treść regulaminu</h1><hr><label>
                <textarea  name="content" id="content" placeholder="Wpisz regulamin">{{ $value->content }}</textarea>
            </div>
            <button type="submit" style="cursor: pointer;" class="btn btn-success">Edytuj</button>
        </form>
    </div>
    @endforeach
@endsection
@section('scripts')
    <script type="text/javascript" src="{{url('../js/languages/pl.js')}}"></script>
    <script>
        $(function() {
            $('textarea').froalaEditor({
                heightMin: 1000,
                language: 'pl'
            })
        });
    </script>

@endsection