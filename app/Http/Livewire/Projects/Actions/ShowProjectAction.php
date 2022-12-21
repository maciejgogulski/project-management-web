<?php

namespace App\Http\Livewire\Projects\Actions;

use LaravelViews\Actions\RedirectAction;
use LaravelViews\Views\View;

class ShowProjectAction extends RedirectAction
{
    public function __construct(string $to, string $title, string $icon = 'eye')
    {
        parent::__construct($to, $title, $icon);
    }

    public function renderIf($model, View $view)
    {
        return $model->deleted_at == null;
    }
}
