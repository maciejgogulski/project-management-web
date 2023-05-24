<?php

namespace App\Http\Rest;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class ProjectApiController extends Controller
{
    public function index() {
        return Project::query()
            ->select('id', 'name')
            ->where('user_id', '=' , Auth::user()->id)
            ->orderBy('name')
            ->get();
    }

    public function projectWithTasks() {
        return Project::with('tasks')
            ->where('user_id', '=' , Auth::user()->id)
            ->orderBy('name')
            ->get();
    }

    public function show(Project $project) {
        if (!Auth::user()->isAdmin()) {
            if ($project->user == null || Auth::user()->id != $project->user->id) {
                abort(403);
            }
        }

        return Project::with('user', 'tasks')
            ->where('id', '=', $project->id)
            ->where('user_id', '=' , Auth::user()->id)
            ->get()
            ->first();
    }
}
