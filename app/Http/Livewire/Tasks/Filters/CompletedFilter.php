<?php

namespace App\Http\Livewire\Tasks\Filters;

use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Filters\Filter;

class CompletedFilter extends Filter
{
    public $title = '';

    public function __construct()
    {
        parent::__construct();
        $this->title = __('tasks.attributes.completed');
    }

    public function apply(Builder $query, $value, $request): Builder {
        if ($value == 1) {
            return $query->where('completed', true);
        }
        return $query->where('completed', false);
    }

    public function options(): array {
        return [
            __('translation.yes') => 1,
            __('translation.no') => 0,
        ];
    }
}
