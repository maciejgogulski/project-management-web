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
        <div class="flex justify-end pt-2">
            <x-button href="{{ route('tasks.edit', [$task]) }}" primary class="mr-2"
                      label="{{ __('translation.edit') }}"></x-button>
            <x-button href="{{ route('tasks.index') }}" secondary class="mr-2"
                      label="{{ __('translation.back') }}"></x-button>
        </div>
    </form>
</div>
