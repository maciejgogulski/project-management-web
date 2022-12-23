<?php

namespace App\Http\Livewire\Tasks;

use App\Models\Task;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use WireUi\Traits\Actions;

class TaskShow extends Component
{
    use Actions;
    use AuthorizesRequests;

    public Task $task;

    public function mount(Task $task)
    {
        $this->task = $task;
    }

    public function render()
    {
        return view('livewire.tasks.task-show');
    }
}
