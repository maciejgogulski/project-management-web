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
                    <p class="font-semibold"> {{ __('tasks.attributes.completed') }} </p>
                    <hr class="my-1">
                    @if($project->tasks->count() > 0)
                        @foreach($project->tasks as $task)
                            @if($task->completed)
                                <a href="{{ route('tasks.show', [$task]) }}" class="bg-green-100 hover:bg-green-200"> {{ $task->name }} </a>
                            @endif
                        @endforeach
                    @else
                        <p> {{__('projects.attributes.no_tasks')}} </p>
                    @endif
                </div>
            </div>
            <div class="">
                <div class="grid grid-cols-1 gap-2">
                    <p class="font-semibold"> {{ __('tasks.attributes.not_completed') }} </p>
                    <hr class="my-1">
                    @if($project->tasks->count() > 0)
                        @foreach($project->tasks as $task)
                            @if(!$task->completed)
                                <a href="{{ route('tasks.show', [$task]) }}" class="hover:bg-gray-200"> {{ $task->name }} </a>
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
        <a class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            {{ __('translation.notes') }}
        </a>
    </div>
    <div class="collapse" id="collapseExample">
        <hr class="my-1">
        @foreach($project->notes as $note)
            <div class="block p-6 rounded-lg shadow-lg bg-white">
                <livewire:notes.note-show :projectNote="$note"/>
            </div>
        @endforeach
    </div>
</div>
