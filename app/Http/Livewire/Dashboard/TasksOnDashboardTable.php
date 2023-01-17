<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use WireUi\Traits\Actions;

class TasksOnDashboardTable extends Component
{
    use Actions;
    use AuthorizesRequests;

    public bool $afterDeadline;

    public function mount(bool $afterDeadline = false)
    {
        $this->afterDeadline = $afterDeadline;
    }

    public function render()
    {
        return view('livewire.dashboard.tasks-table');
    }

    public function getTasks()
    {
        if ($this->afterDeadline) {
            return Task::query()
                ->where('user_id', '=', Auth::id())
                ->where('completed', '=', false)
                ->whereDate('deadline', '<', Carbon::now()->toDateTimeString())
                ->orderBy('deadline', 'desc')
                ->get();
        }
        return Task::query()
        ->where('user_id', '=', Auth::id())
            ->where('completed', '=', false)
            ->whereDate('deadline', '>=', Carbon::now()->toDateTimeString())
        ->orderBy('deadline', 'desc')
        ->get();
    }

    public function showTask($task) {
        $task = Task::where('id', '=', $task['id'])
            ->get()->first();
        $this->redirect(route('tasks.show', [$task]));
    }
}
