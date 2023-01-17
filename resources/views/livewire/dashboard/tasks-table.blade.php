<div class="flex flex-col">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <table class="min-w-full">
                    <thead class="border-b">
                    <tr>
                        <th scope="col" class="text-sm font-medium font-bold {{$this->afterDeadline ? 'text-red-500' : 'text-green-500'}} px-6 py-4 text-left">
                            {{ __('tasks.attributes.name') }}
                        </th>
                        <th scope="col" class="text-sm font-medium font-bold {{$this->afterDeadline ? 'text-red-500' : 'text-green-500'}} px-6 py-4 text-left">
                            {{ __('tasks.attributes.project') }}
                        </th>
                        <th scope="col" class="text-sm font-medium font-bold {{$this->afterDeadline ? 'text-red-500' : 'text-green-500'}} px-6 py-4 text-left">
                            {{ __('tasks.attributes.deadline') }}
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($this->getTasks()->count() > 0)
                        @foreach($this->getTasks() as $task)
                            <tr wire:click="showTask({{ $task }})" class="z-30 border-b {{ $this->afterDeadline ? 'hover:bg-red-200' : 'hover:bg-green-200'}}">
                                <td class="text-sm text-gray-900 font-light px-6 py-4">
                                    {{ $task->name }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4">
                                    {{ isset($task->project) ? $task->project->name : '' }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4">
                                    {{ isset($task->deadline) ? $task->deadline : ''}}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <td colspan="3" class="text-center px-6 py-4"> {{ __('tasks.attributes.no_tasks') }} </td>
                    @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
