<?php

namespace App\Http\Livewire\Projects\Filters;

use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Filters\Filter;

class ManagerAssignedFilter extends Filter
{
    public $title = '';

    public function __construct()
    {
        parent::__construct();
        $this->title = __('projects.attributes.manager_assigned');
    }

    public function apply(Builder $query, $value, $request): Builder {
        if ($value == 1) {
            return $query->whereNotNull('user_id');
        }
        return $query->whereNull('user_id');
    }

    public function options(): array {
        return [
            __('translation.yes') => 1,
            __('translation.no') => 0,
        ];
    }
}
