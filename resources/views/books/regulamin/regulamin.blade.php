@extends('books.layout.layout')
@section('content')
    <div class="container">
        <h1 class="text-center" style="margin: 1rem;">Regulamin
        @if(Auth::user()->roles[0]->name === 'Administrator')
        <button type="button" class="btn btn-primary btn-sm">Small button</button>
        @endif
        
        </h1>
        <hr>
        <div class="content">
            @foreach($regulamin as $reg) 
                {!! $reg->content !!}
            @endforeach
        </div>
    </div>
@endsection