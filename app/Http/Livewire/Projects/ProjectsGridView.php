<?php

namespace App\Http\Livewire\Projects;

use App\Http\Livewire\Current;
use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Views\GridView;

class ProjectsGridView extends GridView
{
    public $cardComponent = 'livewire.projects.project-card';
    /**
     * Sets a model class to get the initial data
     */
    protected $model = Project::class;

    protected $paginate = 20;
    public $maxCols = 3;

    /**
     * Sets the data to every card on the view
     *
     * @param $model Current model for each card
     */
    public function card($model)
    {
        return [
            'name' => $model->name,
            'user' => $model->user->name ?? '',
            'tasks' => $model->tasks,
        ];
    }

    public function repository():Builder
    {
        $query = Project::query()->with(['tasks', 'user']);
        if (request()->user()->can('projects_manage', Project::class)) {
            $query->withTrashed();
        }
        return $query;
    }

    public function getPaginatedQueryProperty()
    {
        return $this->query->paginate($this->paginate);
    }
}
