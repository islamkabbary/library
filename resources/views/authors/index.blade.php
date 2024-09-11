@extends('layout')

@push('style')
    <script src="https://cdn.tailwindcss.com"></script>
@endpush

@section('title')
    Show All Authors
@endsection
@section('content')
    <div class="grid grid-cols-4 gap-5 p-5">
        @foreach ($authors as $author)
            <a href="{{ route('authors.show', ['id' => $author->id]) }}"
                class="bg-orange-500 rounded text-center text-white p-3">
                <h1 class="font-bold my-2 text-2xl underline">{{ $author->name }}</h1>
                <h1 class="text-red-500">Books</h1>
                @foreach ($author->books as $book)
                    <p>title book : {{ $book->title }}</p>
                @endforeach
            </a>
        @endforeach
        {{ $authors->links() }}
    </div>
@endsection



@push('script')
    <script src="{{ asset('js/main.js') }}"></script>
@endpush
