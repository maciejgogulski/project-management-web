<?php

namespace App\Http\Livewire\Projects;

use App\Http\Livewire\Actions\EditAction;
use App\Http\Livewire\Actions\ShowAction;
use App\Http\Livewire\Actions\SoftDeleteAction;
use App\Http\Livewire\Projects\Filters\HasTasksFilter;
use App\Http\Livewire\Projects\Filters\ManagerAssignedFilter;
use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;


class ProjectsTableView extends TableView
{
    /**
     * Sets a model class to get the initial data
     */
    protected $model = Project::class;

    public $searchBy = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $buttons;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->buttons = $this->buttons();
    }


    public function buttons():array {
        return [
            'create' => [
                'route' => 'projects.create',
                'label' => __('projects.labels.create'),
            ],
        ];
    }

    public function repository():Builder
    {
        return Project::query()->withTrashed();
    }
    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title(__('projects.attributes.name'))->sortBy('name'),
            Header::title(__('projects.attributes.manager'))->sortBy('user'),
            Header::title(__('projects.attributes.number_of_tasks')),
            Header::title(__('translation.attributes.created_at'))->sortBy('created_at'),
            Header::title(__('translation.attributes.updated_at'))->sortBy('updated_at'),
            Header::title(__('translation.attributes.deleted_at'))->sortBy('deleted_at'),
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {
        return [
            $model->name,
            $model->user->name ?? '',
            $model->tasks->count(),
            $model->created_at,
            $model->updated_at,
            $model->deleted_at,
        ];
    }

    protected function actionsByRow(): array
    {
        return [
            new ShowAction('projects.show', __('translation.show')),
            new EditAction('projects.edit', __('translation.edit')),
            new SoftDeleteAction,
        ];
    }

    protected function filters()
    {
        return [
            new ManagerAssignedFilter,
            new HasTasksFilter,
        ];
    }
}
