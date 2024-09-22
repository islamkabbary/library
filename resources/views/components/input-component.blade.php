<div class="{{ $class ?? "" }}">
    <label for="{{ $name }}"
        class="block text-gray-700 text-sm font-bold mb-2 capitalize">{{ $name }}:</label>
    <input type="{{ $type }}" id="{{ $id ?? '' }}" name="{{ $name }}" value="{{ $value ?? "" }}"
        class="form-input mt-1 block w-full rounded-md shadow-sm focus:outline-none border border-black/15 p-2 @error("$name") border-2 border-red-800 @enderror">
    <x-error-component>
        <x-slot name='nameInput'>{{$name}}</x-slot>
    </x-error-component>
</div>
