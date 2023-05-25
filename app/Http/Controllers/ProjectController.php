<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('projects.manage_self', Project::class);
        return view(
            'projects.index',
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
            'projects.form',
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        if (!Auth::user()->isAdmin()) {
            if ($project->user == null || Auth::user()->id != $project->user->id) {
                abort(403);
            }
        }
        return view(
            'projects.show',
            [
                'project' => $project
            ],
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        if (!Auth::user()->isAdmin()) {
            if ($project->user == null || Auth::user()->id != $project->user->id) {
                abort(403);
            }
        }
        return view(
            'projects.form',
            [
                'project' => $project
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
        $this->authorize('viewAny', Project::class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
    }

    public function async(Request $request)
    {
        // TODO Pobranie projektów należących do zwykłego usera, potrzebne do formularza dadawania i edycji zadania.
        if (Auth::user()->can('projects.manage')) {
            return Project::query()
                ->select('id', 'name')
                ->orderBy('name')
                ->when(
                    $request->search,
                    fn(Builder $query) => $query->where('name', 'like', "%{$request->search}%")
                )->when(
                    $request->exists('selected'),
                    fn(Builder $query) => $query->whereIn(
                        'id',
                        $request->input('selected', [])
                    ),
                    fn(Builder $query) => $query->limit(5)
                )->get();
        }
        return Project::query()
            ->select('id', 'name')
            ->orderBy('name')
            ->where('user_id', '=' , Auth::user()->id)
            ->when(
                $request->search,
                fn(Builder $query) => $query->where('name', 'like', "%{$request->search}%")
            )->when(
                $request->exists('selected'),
                fn(Builder $query) => $query->whereIn(
                    'id',
                    $request->input('selected', [])
                ),
                fn(Builder $query) => $query->limit(5)
            )->get();
    }
}
