<?php

namespace App\Http\Livewire\Projects;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use WireUi\Traits\Actions;

class ProjectShow extends Component
{
    use Actions;
    use AuthorizesRequests;

    public Project $project;

    protected $listeners = [
        'refreshComponent' => '$refresh',
    ];

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function render()
    {
        return view('livewire.projects.project-show');
    }

    public function markUnfinished($taskId) {
        $task = Task::where('id', '=', $taskId)
            ->get()
            ->first();

        $task->completed = false;

        DB::transaction(function () use ($task) {
            $task->save();
        });

        $this->emit('refreshComponent');
    }

    public function markFinished($taskId) {
        $task = Task::where('id', '=', $taskId)
            ->get()
            ->first();

        $task->completed = true;

        DB::transaction(function () use ($task) {
            $task->save();
        });

        $this->emit('refreshComponent');
    }
}
