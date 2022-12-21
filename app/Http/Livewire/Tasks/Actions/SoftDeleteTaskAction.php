<?php

namespace App\Http\Livewire\Tasks\Actions;

use App\Actions\Current;
use App\Actions\Model;
use App\Models\Task;
use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class SoftDeleteTaskAction extends Action
{
    /**
     * Any title you want to be displayed
     * @var String
     * */
    public $title = "";

    /**
     * This should be a valid Feather icon string
     * @var String
     */
    public $icon = "trash";

    public function __construct()
    {
        parent::__construct();
        $this->title = __('translation.delete');
    }
    /**
     * Execute the action when the user clicked on the button
     *
     * @param $model Model object of the list where the user has clicked
     * @param $view Current view where the action was executed from
     */
    public function handle(Task $model, View $view)
    {
        $model->delete();
        $this->success(__('projects.messages.successes.deleted', ['name' => $model->name]));
    }

    public function renderIf($model, View $view)
    {
        return !$model->trashed();
    }
}
