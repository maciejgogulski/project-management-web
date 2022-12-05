<?php

namespace App\Http\Livewire\Projects\Filters;

use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Filters\Filter;
use function PHPUnit\Framework\isEmpty;

class HasTasksFilter extends Filter
{
    public $title = '';

    public function __construct()
    {
        parent::__construct();
        $this->title = __('projects.attributes.has_tasks');
    }

    public function apply(Builder $query, $value, $request): Builder {
        if($value == 1) {
            return $query->whereHas('tasks');
        }
        return $query->whereDoesntHave('tasks');
    }

    public function options(): array {
        return [
            __('translation.yes') => 1,
            __('translation.no') => 0,
        ];
    }
}
