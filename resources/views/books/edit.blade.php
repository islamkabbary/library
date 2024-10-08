@extends('layout')
@section('title')
    Edit - {{ $book->title }}
@endsection

@push('style')
    <script src="https://cdn.tailwindcss.com"></script>
@endpush

@section('content')
    <div class="container p-6 w-1/2 mx-auto">
        <h1 class="text-3xl font-semibold mb-6">Edit - {{ $book->title }}</h1>
        <form action="{{ route('books.update', ['id' => $book->id]) }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                <input type="text" id="title" name="title" value="{{ old('title') ?? $book->title }}"
                    class="form-input mt-1 block w-full rounded-md shadow-sm focus:outline-none border border-black/15 p-2 @error('title') border-2 border-red-800 @enderror">
                @error('title')
                    <div class="p-2 bg-red-300 rounded my-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                <textarea id="description" name="description"
                    class="form-textarea mt-1 block w-full rounded-md shadow-sm border border-black/15 p-2">{{ old('description') ?? $book->decs }}</textarea>
                @error('description')
                    <div class="p-2 bg-red-300 rounded my-2">{{ $message }}</div>
                @enderror
            </div>
            @if ($book->img)
                {{-- <img src="{{ asset('storage/' . $book->img) }}"> --}}
            @endif
            <div class="mb-4">
                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Book Image:</label>
                <input type="file" id="image" name="image"
                    class="form-input mt-1 block w-full rounded-md shadow-sm focus:outline-none border border-black/15 p-2 @error('image') border-2 border-red-800 @enderror">
                @error('image')
                    <div class="p-2 bg-red-300 rounded my-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="category_id" class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                <select name="category_id[]" multiple
                    class="form-input mt-1 block w-full rounded-md shadow-sm focus:outline-none border border-black/15 p-2">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if (in_array($category->id, $book->categories()->pluck('category_id')->toArray())) selected @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="p-2 bg-red-300 rounded my-2">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-sm hover:bg-blue-600">edit
                Book</button>
        </form>
    </div>
@endsection
