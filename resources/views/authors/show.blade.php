@extends('layout')
@section('title')
    Show Author - {{ $author ? $author->title : null }}
@endsection

@push('style')
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
    @if ($author)
        <div class="bg-orange-500 rounded text-center text-white p-3">
            <h1 class="font-bold my-2 text-2xl underline">{{ $author->name }}</h1>
        </div>
    @endif
@endsection
