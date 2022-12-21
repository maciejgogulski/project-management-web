<div class="p-2">
    <form wire:submit.prevent="save">
        <h3 class="text-xl font-semibold leading-tight text-gray-800">
            @if ($editMode)
                {{ __('tasks.labels.edit_form_title') }}
            @else
                {{ __('tasks.labels.create_form_title') }}
            @endif
        </h3>
        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="name">
                    {{ __('tasks.attributes.name') }}
                </label>
            </div>
            <div class="">
                <x-input wire:model="task.name" placeholder="{{ __('tasks.placeholders.enter_name') }}"/>
            </div>
        </div>
        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="user">
                    {{ __('tasks.attributes.user') }}
                </label>
            </div>
            <div class="">
                <x-select
                    wire:model="task.user_id"
                    placeholder="{{ __('tasks.placeholders.choose_user') }}"
                    :async-data="route('async.users')"
                    option-label="name"
                    option-value="id"
                />
            </div>
        </div>
        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="project">
                    {{ __('tasks.attributes.project') }}
                </label>
            </div>
            <div class="">
                <x-select
                    wire:model="task.project_id"
                    placeholder="{{ __('tasks.placeholders.choose_project') }}"
                    :async-data="route('async.projects')"
                    option-label="name"
                    option-value="id"
                />
            </div>
        </div>
        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="deadline">
                    {{ __('tasks.attributes.deadline') }}
                </label>
            </div>
            <div class="">
                <x-datetime-picker
                    wire:model="task.deadline"
                    placeholder="{{ __('tasks.placeholders.pick_deadline') }}"
                    parse-format="YYYY-MM-DD HH:mm"
                    wire:model.defer="customFormat"
                />
            </div>
        </div>
        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-button href="{{ route('tasks.index') }}" secondary class="mr-2"
                      label="{{ __('translation.back') }}"></x-button>
            <x-button type="submit" primary label="{{ __('translation.save') }}" spinner></x-button>
        </div>
    </form>
</div>
