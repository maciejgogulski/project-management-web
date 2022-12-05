<?php

namespace App\Http\Livewire\Tasks;

use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
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

    public function repository():Builder
    {
        return Task::query()->withTrashed();
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title(__('tasks.attributes.name'))->sortBy('name'),
            Header::title(__('translation.project'))->sortBy('project'),
            Header::title(__('translation.user'))->sortBy('user'),
            Header::title(__('tasks.attributes.deadline'))->sortBy('deadline'),
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
            $model->project->name ?? '',
            $model->user->name ?? '',
            $model->deadline,
            $model->created_at,
            $model->updated_at,
            $model->deleted_at,
        ];
    }
}
