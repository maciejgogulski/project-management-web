<?php

namespace App\Http\Livewire\Tasks\Filters;

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
        if ($value == 1) {
            return $query->whereNotNull('project_id');
        }
        return $query->whereNull('project_id');
    }

    public function options(): array {
        return [
            __('translation.yes') => 1,
            __('translation.no') => 0,
        ];
    }
}
