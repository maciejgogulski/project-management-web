<?php

namespace App\Http\Rest;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskApiController extends Controller
{
    public function show(Task $task)
    {
        $this->hasAccess($task);

        $taskData = Task::with('user:id,name', 'project:id,name', 'notes')
            ->where('id', '=', $task->id)
            ->first();

        if (!$taskData) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        $response = $taskData->toArray();
        $response['user_id'] = $taskData->user ? $taskData->user->id : null;
        $response['user_name'] = $taskData->user ? $taskData->user->name : null;
        $response['project_id'] = $taskData->project ? $taskData->project->id : null;
        $response['project_name'] = $taskData->project ? $taskData->project->name : null;

        unset($response['user']);
        unset($response['project']);

        return $response;
    }

    public function store(Request $request) {
        $task = new Task();
        $task->name = $request->input('name');
        $task->deadline = $request->input('deadline');
        $task->project_id = $request->input('project_id');
        $task->user_id = $request->input('user_id');
        $task->completed = $request->input('completed');
        $task->save();
        return response()->json($task);
    }

    public function update(Request $request, Task $task) {
        $this->hasAccess($task);

        $task->name = $request->input('name');
        $task->deadline = $request->input('deadline');
        $task->project_id = $request->input('project_id');
        $task->user_id = $request->input('user_id');
        $task->completed = $request->input('completed');
        $task->save();
        return response()->json($task);
    }

    public function delete(Task $task) {
        $this->hasAccess($task);

        $task->delete();
    }

    private function hasAccess(Task $task) {
        // Dostęp do konkretnego zadania:
        // Jeżeli user jest adminem, to ma dostęp do kaźdego zadania.
        // Jeżeli jest właścicielem projektu nadrzędnego, to ma dostęp do każdego zadania w tym projekcie.
        // Jeżeli jest przypisany do tego zadania, to ma do niego dostęp.
        if (!Auth::user()->isAdmin()) {
            if (
                ($task->user == null || Auth::user()->id != $task->user->id)
                &&
                ($task->project == null || $task->project->user == null || $task->project->user->id != Auth::user()->id)
            )
            {
                abort(403);
            }
        }
    }

    public function afterDeadlineTasks() {
        return Task::query()
            ->where('user_id', '=', Auth::id())
            ->where('completed', '=', false)
            ->whereDate('deadline', '<', Carbon::now()->toDateTimeString())
            ->orderBy('deadline', 'desc')
            ->get();
    }

    public function beforeDeadlineTasks() {
        return Task::query()
            ->where('user_id', '=', Auth::id())
            ->where('completed', '=', false)
            ->whereDate('deadline', '>=', Carbon::now()->toDateTimeString())
            ->orderBy('deadline', 'desc')
            ->get();
    }
}
