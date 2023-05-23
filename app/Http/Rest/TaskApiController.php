<?php

namespace App\Http\Rest;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskApiController extends Controller
{
    public function store(Request $request) {
        $task = new Task();
        $task->name = $request->input('name');
        $task->deadline = $request->input('deadline');
        $task->project_id = $request->input('projectId');
        $task->user_id = $request->input('userId');
        $task->completed = $request->input('completed');
        $task->save();
        return response()->json($task);
    }

    public function update(Request $request, Task $task) {
        $task->name = $request->input('name');
        $task->deadline = $request->input('deadline');
        $task->project_id = $request->input('projectId');
        $task->user_id = $request->input('userId');
        $task->completed = $request->input('completed');
        $task->save();
        return response()->json($task);
    }
}
