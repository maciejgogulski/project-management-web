<div class="">
    <div class="">
        @if($editMode || $createMode)
            <form wire:submit.prevent="save">
                <h3 class="inline-block text-sm text-primary-600">{{ $createMode ? __('notes.labels.create_mode') : __('notes.labels.edit_mode') }}</h3>
                <x-button type="submit" primary label="{{ __('translation.save') }}" spinner
                          class="inline-block ml-2 px-1 py-1"></x-button>
                @if($editMode)
                    <x-button secondary wire:click="toggleEditMode" class="inline-block px-1 py-1">
                        {{__('translation.cancel')}}
                    </x-button>
                @endif

                <hr class="my-2">

                <div class="{{ $editMode || $createMode ? 'p-5 bg-green-100 rounded-b-md' : '' }}">

                    <div class="">
                        <x-textarea wire:model="note.content"
                                    placeholder="{{ __('notes.placeholders.enter_content') }}"/>
                    </div>

                </div>
            </form>
        @else
            <h3 class="inline-block text-sm text-primary-600">{{ __('translation.attributes.updated_at') }}
                : {{$note->updated_at}}</h3>
            <x-button primary wire:click="toggleEditMode" class="inline-block mx-2 px-1 py-1">
                {{__('translation.edit')}}
            </x-button>

            <hr class="my-2">

            {{ $note->content }}
        @endif

    </div>

</div>
