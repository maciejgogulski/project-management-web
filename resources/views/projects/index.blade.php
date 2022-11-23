<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('translation.navigation.projects') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg" id="table-view-wrapper">
                <livewire:projects.projects-table-view />
            </div>
        </div>
    </div>
</x-app-layout>
<!-- TODO: Poprawić ścieżkę do widoku tabeli