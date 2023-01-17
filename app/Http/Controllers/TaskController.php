<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('tasks.manage_self', Task::class);
        return view(
            'tasks.index',
        );
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('tasks.manage_self', Task::class);
        return view(
            'tasks.form',
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('viewAny', Task::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
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
        return view(
            'tasks.show',
            [
                'task' => $task
            ],
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        // Takie same permisje jak w endpoincie show()
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
        return view(
            'tasks.form',
            [
                'task' => $task
            ],
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('viewAny', Task::class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('viewAny', Task::class);
    }
}
