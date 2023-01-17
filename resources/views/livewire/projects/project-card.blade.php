@props([
'name' => '',
'user' => '',
'tasks' => [],
'withBackground' => true,
'model',
'actions' => [],
'hasDefaultAction' => false,
'selected' => false
])

<div class="rounded-md shadow-md bg-slate-200 {{ $tasks->count() < 5 ? 'h-32' : '' }}">
    <h2 class="font-bold text-2xl text-gray-900">
        {!! $name !!}
    </h2>

    <div class="pt-4 {{ $withBackground ? 'bg-white rounded-b-md p-4' : '' }}">
        <div class="flex items-start">
            <div class="flex-1">
                <h3 class="font-bold leading-6 text-gray-900">
                    <a href="#!" class="hover:underline" wire:click.prevent="onCardClick({{ $model->getKey() }})">
                        {!! $user !!}
                    </a>
                </h3>
                    @foreach($tasks as $task)
                <span class="text-sm text-gray-600">
                    {!! $task->name !!}
                </span>
                    @endforeach
            </div>

            @if (count($actions))
            <div class="flex justify-end items-center">
                <x-lv-actions.drop-down :actions="$actions" :model="$model" />
            </div>
            @endif
        </div>

        @if (isset($description))
        <p class="line-clamp-3 mt-2">
            {!! $description !!}
        </p>
        @endif
    </div>

</div>
