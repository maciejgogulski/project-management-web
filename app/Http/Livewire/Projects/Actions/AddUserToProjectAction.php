<?php

namespace App\Http\Livewire\Projects\Actions;

use App\Http\Projects\Actions\Current;
use App\Http\Projects\Actions\Model;
use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class AddUserToProjectAction extends Action
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
    public $icon = "user-plus";

    public function __construct()
    {
        parent::__construct();
        $this->title = __('projects.actions.add_user');
    }

    /**
     * Execute the action when the user clicked on the button
     *
     * @param $model Model object of the list where the user has clicked
     * @param $view Current view where the action was executed from
     */
    public function handle($model, View $view)
    {
        throw new \Exception("Not implemented yet");
    }

    public function renderIf($model, View $view)
    {
        return !$model->trashed();
    }
}
