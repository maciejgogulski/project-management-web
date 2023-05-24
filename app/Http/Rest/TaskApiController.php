<?php

namespace App\Http\Rest;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskApiController extends Controller
{

    public function show(Task $task) {
        $this->hasAccess($task);

        return Task::with('user', 'project')
            ->where('id', '=', $task->id)
            ->get()
            ->first();
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
}
