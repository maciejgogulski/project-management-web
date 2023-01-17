<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('translation.navigation.tasks')}}
        </h2>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg">
                    @if (isset($task))
                        <livewire:tasks.task-show :task="$task"/>
                    @else
                        <div> {{ __('tasks.attributes.not_found') }} </div>
                    @endif
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
