<?php

namespace App\Http\Livewire\Tasks;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use WireUi\Traits\Actions;

class TaskForm extends Component
{
    use Actions;
    use AuthorizesRequests;

    public Task $task;
    public bool $editMode;

    public function rules()
    {
        return [
            'task.name' => [
                'required',
                'string',
                'min:2'
            ],
            'task.user_id' => [
                'nullable',
                'integer',
                'exists:users,id'
            ],
            'task.project_id' => [
                'nullable',
                'integer',
                'exists:projects,id'
            ],
            'task.deadline' => [
                'request_date' => [
                    'required',
                    'date_format: Y-m-d H:i:s'
                ],
            ],
            'task.completed' => [
                ''
            ]
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => Str::lower(__('tasks.attributes.name')),
            'user_id' => Str::lower(__('tasks.attributes.user')),
            'project_id' => Str::lower(__('tasks.attributes.project')),
            'deadline' => Str::lower(__('tasks.attributes.deadline')),
            'completed' => Str::lower(__('tasks.attributes.completed')),
        ];
    }

    public function mount(Task $task, bool $editMode)
    {
        $this->task = $task;
        $this->editMode = $editMode;
    }

    public function render()
    {
        return view('livewire.tasks.task-form');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        sleep(1);
        $this->validate();

        $task = $this->task;

        if (!$this->editMode) {
            $task->completed = false;
        }

        DB::transaction(function () use ($task) {
            $task->save();
        });

        $this->notification()->success(
            $this->editMode
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            $description = $this->editMode
                ? __('tasks.messages.successes.updated', ['name' => $this->task->name])
                : __('tasks.messages.successes.stored', ['name' => $this->task->name])
        );
        $this->editMode = true;
    }
}
