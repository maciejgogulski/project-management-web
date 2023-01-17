<?php

namespace App\Http\Livewire\Actions;

use App\Actions\Current;
use Illuminate\Database\Eloquent\Model;
use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class SoftDeleteAction extends Action
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
    public function handle(Model $model, View $view)
    {
        $model->delete();
        $this->success(__('translation.messages.successes.deleted') . ' ' .$model->name);
    }

    public function renderIf($model, View $view)
    {
        return !$model->trashed();
    }
}
