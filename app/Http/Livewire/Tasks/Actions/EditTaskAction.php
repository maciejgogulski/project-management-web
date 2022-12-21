<?php

namespace App\Http\Livewire\Tasks\Actions;

use LaravelViews\Actions\RedirectAction;
use LaravelViews\Views\View;

class EditTaskAction extends RedirectAction
{
    public function __construct(string $to, string $title, string $icon = 'edit')
    {
        parent::__construct($to, $title, $icon);
    }

    public function renderIf($model, View $view)
    {
        return $model->deleted_at == null;
    }
}
