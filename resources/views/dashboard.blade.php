<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a class="btn btn-lg btn-block btn-primary" href="{{ route('jti.create') }}" role="button">Input</a>
            <a class="btn btn-lg btn-block btn-secondary" href="{{ route('jti') }}" role="button">Output</a>
        </div>
    </div>
</x-app-layout>
