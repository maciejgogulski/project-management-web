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
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label>
                    {{ __('translation.navigation.tasks') }}
                </label>
            </div>
            <div class="">
                <div class="grid grid-cols-1 gap-2">
                    @if($project->tasks->count() > 0)
                        @foreach($project->tasks as $task)
                            <a href="{{ route('tasks.show') }}" class="hover:bg-gray-100"> {{ $task->name }} </a>
                        @endforeach
                    @else
                        <p> {{__('projects.attributes.no_tasks')}} </p>
                    @endif
                </div>
            </div>
        </div>
        <div class="flex justify-end pt-2">

        </div>
    </form>
</div>
