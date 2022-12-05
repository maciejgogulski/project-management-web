<div class="p-2">
    <form wire:submit.prevent="save">
        <h3 class="text-xl font-semibold leading-tight text-gray-800">
            @if ($editMode)
                {{ __('projects.labels.edit_form_title') }}
            @else
                {{ __('projects.labels.create_form_title') }}
            @endif
        </h3>
        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="name">
                    {{ __('projects.attributes.name') }}
                </label>
            </div>
            <div class="">
                <x-input wire:model="project.name" placeholder="{{ __('projects.placeholders.enter_name') }}" />
            </div>
        </div>
        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-button href="{{ route('projects.index') }}" secondary class="mr-2" label="{{ __('translation.back') }}"></x-button>
            <x-button type="submit" primary label="{{ __('translation.save') }}" spinner></x-button>
        </div>
    </form>
</div>
