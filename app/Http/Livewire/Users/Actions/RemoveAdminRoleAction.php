<?php

namespace App\Http\Livewire\Users\Actions;

use Illuminate\Support\Facades\Auth;
use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class RemoveAdminRoleAction extends Action
{
    public $title = '';
    public $icon = 'shield';

    public function __construct()
    {
        parent::__construct();
        $this->title = __('users.actions.remove_admin_role');
    }

    public function handle($model, View $view)
    {
        $model->removeRole(config('auth.roles.admin'));
        $this->success(__('users.messages.successes.admin_role_removed'));
    }

    public function renderIf($model, View $view)
    {
        return Auth::user()->isAdmin()
            && $model->hasRole(config('auth.roles.admin'));
    }


}
