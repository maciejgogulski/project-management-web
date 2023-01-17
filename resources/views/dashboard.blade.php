<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('translation.navigation.dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="grid grid-cols-5 gap-5">
                    <div class="rounded bg-primary-100 col my-5 ml-5">
                        <p class="text-center font-bold text-primary-500 mt-10"> {{ __('dashboard_trans.my_projects') }} </p>
                        <hr class="m-2"/>
                        <livewire:dashboard.project-list/>
                    </div>

                    <div class="rounded bg-red-100 my-5 col-span-2">
                        <p class="text-center font-bold text-red-500 mt-10"> {{ __('tasks.attributes.after_term') }} </p>
                        <hr class="m-2"/>
                        <livewire:dashboard.tasks-table :afterDeadline="true"/>
                    </div>

                    <div class="rounded bg-green-100 my-5 mr-5 col-span-2">
                        <p class="text-center font-bold text-green-500 mt-10"> {{ __('tasks.attributes.before_term') }} </p>
                        <hr class="m-2"/>
                        <livewire:dashboard.tasks-table :afterDeadline="false"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
