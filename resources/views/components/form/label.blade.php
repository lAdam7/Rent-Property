@props(['name'])

@php
    if ($name == "password_confirmation")
    {
        $name = "Repeat Password";
    }
    if ($name == "images[]")
    {
        $name = "Images";
    }
@endphp

<label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="{{ $name }}">{{ ucwords($name) }}</label>