@extends('layout')

@push('style')
    <script src="https://cdn.tailwindcss.com"></script>
@endpush

@section('title')
    Show All Books
@endsection
@section('content')
    <div class="grid grid-cols-4 gap-5 p-5">
        @foreach ($books as $book)
            <a href="{{ route('books.show', ['id' => $book->id]) }}" class="bg-orange-500 rounded text-center text-white p-3">
                @if ($book->img)
                    <img src="{{ asset('storage/' . $book->img) }}">
                @endif
                <h1 class="font-bold my-2 text-2xl underline">{{ $book->title }}</h1>
                <p>{{ $book->decs }}</p>
                @if ($book->deleted_at)
                <p>deleted({{$book->deleted_at}})</p>
                @endif
            </a>
        @endforeach
        {{-- {{ $books->links() }} --}}
    </div>
@endsection



@push('script')
    <script src="{{ asset('js/main.js') }}"></script>
@endpush
