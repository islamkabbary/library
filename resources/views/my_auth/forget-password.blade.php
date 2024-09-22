@extends('layout')
@section('title')
    Forget Password
@endsection

@push('style')
    <script src="https://cdn.tailwindcss.com"></script>
@endpush

@section('content')
    <div class="container p-6 w-1/2 mx-auto">
        @if (session('status'))
            <div class="bg-green-500 text-white p-2 w-full">{{ session('status') }}</div>
        @endif
        @if (session('email'))
            <div class="bg-green-500 text-white p-2 w-full">{{ session('email') }}</div>
        @endif
        <h1 class="text-3xl font-semibold mb-6">Forget Password</h1>
        <form action="{{ route('my_forget_password') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <x-input-component>
                    <x-slot name='name'>email</x-slot>
                    <x-slot name='type'>email</x-slot>
                </x-input-component>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-sm hover:bg-blue-600">Send
                Email</button>
        </form>
    </div>
@endsection
