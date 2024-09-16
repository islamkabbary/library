@extends('layout')
@section('title')
    Show Book - {{ $book ? $book->title : null }}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
    @if ($book)
        <div class="bg-orange-500 rounded text-center text-white p-3">
            <h1 class="font-bold my-2 text-2xl underline">{{ $book->title }}</h1>
            <p>{{ $book->decs }}</p>
            <p>Author : {{ $book->author->name }}</p>
        </div>
    @endif
@endsection
