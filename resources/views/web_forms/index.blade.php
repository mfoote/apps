<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Web Forms') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <pre>
            {{print_r($entries)}}
        </pre>
    </div>
</x-app-layout>
