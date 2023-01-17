<div class="p-2">
    <h3 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('translation.project') }}: "{{ $project->name }}"
    </h3>
    <hr class="my-2">
    <div class="grid grid-cols-2 gap-2">
        <div class="">
            <label>
                {{ __('projects.attributes.manager') }}
            </label>
        </div>
        <div class="">
            <div class="">
                @if(isset($project->user->name))
                    {{ $project->user->name }}
                @else
                    {{__('projects.attributes.manager_unassigned')}}
                @endif
            </div>
        </div>
    </div>
    <hr class="my-2">
    <div class="grid grid-cols-3 gap-2">
        <div class="">
            <label>
                {{ __('translation.navigation.tasks') }}
            </label>
        </div>
        <div class="pr-5 mr-5 border-r-2">
            <div class="grid grid-cols-1 gap-2">
                <p class="font-semibold"> {{ __('tasks.attributes.not_completed') }} </p>
                <hr class="my-1">
                @if($project->tasks->count() > 0)
                    @foreach($project->tasks as $task)
                        @if(!$task->completed)
                            <div class="relative z-30" x-data="{ tooltip: false }">
                                <div class="relative" x-cloak x-show.transition.origin.top="tooltip">
                                    <div class="absolute top-0 z-10 p-2 -mt-1 -translate-y-full
                                    rounded bg-black text-sm leading-tight text-white transform">
                                        {{ __('tasks.actions.mark_as_finished') }}
                                    </div>
                                </div>
                                <span class="w-2/12 rounded mr-2 hover:bg-green-200"
                                      wire:click="markFinished({{$task->id}})"
                                      x-on:mouseover="tooltip=true" x-on:mouseout="tooltip=false">
                                        <i class="inline-block" data-feather="check"></i>
                                </span>
                                <a href="{{ route('tasks.show', [$task]) }}"
                                   class="rounded bg-red-100 hover:bg-red-200 inline-block w-10/12"> {{ $task->name }} </a>
                            </div>
                        @endif
                    @endforeach
                @else
                    <p> {{__('projects.attributes.no_tasks')}} </p>
                @endif
            </div>
        </div>
        <div class="">
            <div class="grid grid-cols-1 gap-2">
                <p class="font-semibold"> {{ __('tasks.attributes.completed') }} </p>
                <hr class="my-1">
                @if($project->tasks->count() > 0)
                    @foreach($project->tasks as $task)
                        @if($task->completed)
                            <div class="relative z-30" x-data="{ tooltip: false }">
                                <div class="relative" x-cloak x-show.transition.origin.top="tooltip">
                                    <div class="absolute top-0 z-10 p-2 -mt-1 -translate-y-full
                                    rounded bg-black text-sm leading-tight text-white transform">
                                        {{ __('tasks.actions.mark_as_unfinished') }}
                                    </div>
                                </div>
                                <span class="w-2/12 rounded mr-2 hover:bg-red-200"
                                      wire:click="markUnfinished({{$task->id}})"
                                      x-on:mouseover="tooltip=true" x-on:mouseout="tooltip=false">
                                        <i class="inline-block" data-feather="x"></i>
                                </span>
                                <a href="{{ route('tasks.show', [$task]) }}"
                                   class="rounded bg-green-100 hover:bg-green-200 inline-block w-10/12"> {{ $task->name }} </a>
                            </div>
                        @endif
                    @endforeach
                @else
                    <p> {{__('projects.attributes.no_tasks')}} </p>
                @endif
            </div>
        </div>
    </div>
    <hr class="my-2">
    <div class="flex justify-end pt-2">
        <x-button href="{{ route('projects.edit', [$project]) }}" primary class="mr-2"
                  label="{{ __('translation.edit') }}"></x-button>
        <x-button href="{{ route('projects.index') }}" secondary class="mr-2"
                  label="{{ __('translation.back') }}"></x-button>
    </div>
    </form>

    <div class="md:space-x-1 space-y-1 md:space-y-0 mb-4">
        <a class="inline-block px-6 py-2.5 bg-primary-600 text-white text-xs leading-tight rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg transition duration-150 ease-in-out"
           data-bs-toggle="collapse" href="#collapseNotes" role="button" aria-expanded="false"
           aria-controls="collapseNotes">
            {{ __('translation.notes') }}
        </a>

        <a class="inline-block px-6 py-2.5 bg-green-600 text-white text-xs leading-tight rounded shadow-md hover:bg-green-700-700 hover:shadow-lg focus:bg-green-700-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800-800 active:shadow-lg transition duration-150 ease-in-out"
           data-bs-toggle="collapse" href="#collapseCreateNoteForm" role="button" aria-expanded="false"
           aria-controls="collapseCreateNoteForm">
            {{ __('notes.create_note') }}
        </a>
    </div>

    <hr class="my-1">

    <div class="collapse" id="collapseCreateNoteForm">
        <div class="block p-6 rounded-lg shadow-lg bg-white mb-5">
            <livewire:notes.note-show :createMode="true" :project="$project"/>
        </div>
    </div>

    <livewire:notes.note-list :project="$project"/>

</div>
