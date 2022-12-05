<?php

namespace App\Http\Livewire\Tasks\Filters;

use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Filters\Filter;

class ProjectAssignedFilter extends Filter
{
    public $title = '';

    public function __construct()
    {
        parent::__construct();
        $this->title = __('tasks.attributes.project_assigned');
    }

    public function apply(Builder $query, $value, $request): Builder {
        return $query->whereHas('project', function (Builder $query) use ($value) {
            $query-> where('id', '=', $value);
        });
    }

    public function options(): array {
        $projects = Project::all();
        $labels = $projects->pluck('name');
        $values = $projects->pluck('id');
        return $labels->combine($values)->toArray();
    }
}
