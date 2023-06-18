@extends('key_words::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('key_words.name') !!}
    </p>
@endsection
