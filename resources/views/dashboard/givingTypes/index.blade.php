<x-dashboard.layout>
    <div class="container px-6 mx-auto grid">
        <x-dashboard.page-title>Tipos de donaciones</x-dashboard.page-title>

        @if(session()->has('message'))
            <x-dashboard.message>{{ session('message') }}</x-dashboard.message>
        @endif

        @livewire('dashboard.giving-types-table')

        <x-dashboard.modal name="giving-type-creation-modal">
            <x-slot name="title">
                Crear nuevo tipo de donación
            </x-slot>

            <x-slot name="body">
                @livewire('dashboard.giving-types-form')
            </x-slot>
        </x-dashboard.modal>
    </div>
</x-dashboard.layout>
