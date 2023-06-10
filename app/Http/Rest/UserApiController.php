<?php

namespace App\Http\Rest;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserApiController extends Controller
{
    public function index() {
        return User::query()
            ->select('id', 'name')
            ->orderBy('name')
            ->get();
    }
}
