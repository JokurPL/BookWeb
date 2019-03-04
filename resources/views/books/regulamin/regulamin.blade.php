@extends('books.layout.layout')
@section('content')
    <div class="container">
        <h1 class="text-center" style="margin: 1rem;">Regulamin
        @foreach($regulamin as $reg)
        @if(!Auth::guest())
        @if(Auth::user()->roles[0]->name === 'Administrator')
        <a href="{{ route('books.regulamin_edit', $reg->id) }}"  class="btn btn-success btn-sm">Edytuj</a>
        @endif
        @endif
        
        </h1>
        <hr>
        <div class="content">
             
                {!! $reg->content !!}
            @endforeach
        </div>
    </div>
@endsection