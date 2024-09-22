@extends('layout')
@section('title')
    My Register
@endsection

@push('style')
    <script src="https://cdn.tailwindcss.com"></script>
@endpush

@section('content')
    <div class="container p-6 w-1/2 mx-auto">
        <h1 class="text-3xl font-semibold mb-6">My Register</h1>
        @if (session('success'))
            <div class="bg-green-500 text-white p-2 w-full">{{ session('success') }}</div>
        @endif
        <form action="{{ route('my_register') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <x-input-component>
                    <x-slot name='name'>name</x-slot>
                    <x-slot name='type'>text</x-slot>
                </x-input-component>
            </div>
            <div class="mb-4">
                <x-input-component>
                    <x-slot name='name'>email</x-slot>
                    <x-slot name='type'>email</x-slot>
                </x-input-component>
            </div>
            <div class="mb-4">
                <x-input-component>
                    <x-slot name='name'>password</x-slot>
                    <x-slot name='type'>password</x-slot>
                </x-input-component>
            </div>
            <div class="mb-4">
                <x-input-component>
                    <x-slot name='name'>password_confirmation</x-slot>
                    <x-slot name='type'>password</x-slot>
                </x-input-component>
            </div>
            <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-sm hover:bg-blue-600">Register</button>
        </form>
    </div>
@endsection
