<?php

namespace App\Http\Livewire\Tasks;

use App\Http\Livewire\Actions\EditAction;
use App\Http\Livewire\Actions\ShowAction;
use App\Http\Livewire\Actions\SoftDeleteAction;
use App\Http\Livewire\Tasks\Actions\EditTaskAction;
use App\Http\Livewire\Tasks\Actions\ShowTaskAction;
use App\Http\Livewire\Tasks\Actions\SoftDeleteTaskAction;
use App\Http\Livewire\Tasks\Filters\CompletedFilter;
use App\Http\Livewire\Tasks\Filters\ProjectAssignedFilter;
use App\Http\Livewire\Tasks\Filters\UserAssignedFilter;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class TasksTableView extends TableView
{
    /**
     * Sets a model class to get the initial data
     */
    protected $model = Task::class;

    public $searchBy = [
        'name',
        'deadline',
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
        if (Auth::user()->can('tasks.manage_self')) {
            return [
                'create' => [
                    'route' => 'tasks.create',
                    'label' => __('tasks.labels.create'),
                ],
            ];
        }
        return [];
    }

    public function repository():Builder
    {
        if (Auth::user()->isAdmin()) {
            return Task::query()->withTrashed();
        }
        return Task::query()
            ->where('user_id', '=', Auth::user()->id);
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        if (Auth::user()->isAdmin()) {
            return [
                Header::title(__('tasks.attributes.name'))->sortBy('name'),
                Header::title(__('translation.project'))->sortBy('project'),
                Header::title(__('translation.user'))->sortBy('user'),
                Header::title(__('tasks.attributes.completed'))->sortBy('completed'),
                Header::title(__('tasks.attributes.deadline'))->sortBy('deadline'),
                Header::title(__('translation.attributes.created_at'))->sortBy('created_at'),
                Header::title(__('translation.attributes.updated_at'))->sortBy('updated_at'),
                Header::title(__('translation.attributes.deleted_at'))->sortBy('deleted_at'),
            ];
        }

        return [
            Header::title(__('tasks.attributes.name'))->sortBy('name'),
            Header::title(__('translation.project'))->sortBy('project'),
            Header::title(__('tasks.attributes.completed'))->sortBy('completed'),
            Header::title(__('tasks.attributes.deadline'))->sortBy('deadline'),
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {
        if (Auth::user()->isAdmin()) {
            return [
                $model->name,
                $model->project->name ?? '',
                $model->user->name ?? '',
                $model->completed ? __('translation.yes') : __('translation.no'),
                $model->deadline,
                $model->created_at,
                $model->updated_at,
                $model->deleted_at,
            ];
        }

        return [
            $model->name,
            $model->project->name ?? '',
            $model->completed ? __('translation.yes') : __('translation.no'),
            $model->deadline,
        ];
    }

    protected function filters()
    {
        return [
            new CompletedFilter,
            new ProjectAssignedFilter,
            new UserAssignedFilter,
        ];
    }

    protected function actionsByRow(): array
    {
        return [
            new ShowAction('tasks.show', __('translation.show')),
            new EditAction('tasks.edit', __('translation.edit')),
            new SoftDeleteAction,
        ];
    }
}
