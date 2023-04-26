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
}
