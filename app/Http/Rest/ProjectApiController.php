<?php

namespace App\Http\Rest;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectApiController extends Controller
{
    public function index() {
        return Project::query()
            ->select('id', 'name')
            ->orderBy('name')
            //->where('user_id', '=' , Auth::user()->id)
            ->get();
    }
}
