<div class="p-2">
    <h3 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('translation.task') }}: "{{ $task->name }}"
    </h3>
    <hr class="my-2">
    <div class="grid grid-cols-2 gap-2">
        <div class="">
            <label>
                {{ __('translation.project') }}
            </label>
        </div>
        <div class="">
            <div class="">
                @if(isset($task->project))
                    {{ $task->project->name }}
                @else
                    {{__('tasks.attributes.project_unassigned')}}
                @endif
            </div>
        </div>
    </div>
    <hr class="my-2">
    <div class="grid grid-cols-2 gap-2">
        <div class="">
            <label>
                {{ __('tasks.attributes.user') }}
            </label>
        </div>
        <div class="">
            <div class="">
                @if(isset($task->user->name))
                    {{ $task->user->name }}
                @else
                    {{__('tasks.attributes.user_unassigned')}}
                @endif
            </div>
        </div>
    </div>
    <hr class="my-2">
    <div class="grid grid-cols-2 gap-2">
        <div class="">
            <label>
                {{ __('tasks.attributes.deadline') }}
            </label>
        </div>
        <div class="">
            <div class="">
                @if(isset($task->deadline))
                    {{ $task->deadline }}
                @else
                    {{__('tasks.attributes.deadline_not_set')}}
                @endif
            </div>
        </div>
    </div>
    <hr class="my-2">
    <div class="grid grid-cols-2 gap-2">
        <div class="">
            <label>
                {{ __('tasks.attributes.completed') }}
            </label>
        </div>
        <div class="">
            <div class="">
                @if($task->completed)
                    {{ __('translation.yes') }}
                @else
                    {{ __('translation.no') }}
                @endif
            </div>
        </div>
    </div>

    <hr class="my-2">
    <div class="flex justify-end pt-2">
        <x-button href="{{ route('tasks.edit', [$task]) }}" primary class="mr-2"
                  label="{{ __('translation.edit') }}"></x-button>
        <x-button href="{{ route('tasks.index') }}" secondary class="mr-2"
                  label="{{ __('translation.back') }}"></x-button>
    </div>

    <div class="md:space-x-1 space-y-1 md:space-y-0 mb-4">
        <a class="inline-block px-6 py-2.5 bg-primary-600 text-white text-xs leading-tight rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg transition duration-150 ease-in-out"
           data-bs-toggle="collapse" href="#collapseNotes" role="button" aria-expanded="false"
           aria-controls="collapseExample">
            {{ __('translation.notes') }}
        </a>

        <a class="inline-block px-6 py-2.5 bg-green-600 text-white text-xs leading-tight rounded shadow-md hover:bg-green-700-700 hover:shadow-lg focus:bg-green-700-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800-800 active:shadow-lg transition duration-150 ease-in-out"
           data-bs-toggle="collapse" href="#collapseCreateNoteForm" role="button" aria-expanded="false"
           aria-controls="collapseCreateNoteForm">
            {{ __('notes.create_note') }}
        </a>
    </div>

    <hr class="my-1">

    <livewire:notes.note-list :task="$task"/>

</div>
