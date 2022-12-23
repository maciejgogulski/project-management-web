<?php

namespace App\Http\Livewire\Projects;

use App\Models\Project;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use WireUi\Traits\Actions;

class ProjectForm extends Component
{
    use Actions;
    use AuthorizesRequests;

    public Project $project;
    public bool $editMode;

    public function rules()
    {
        return [
            'project.name' => [
                'required',
                'string',
                'min:2'
            ],
            'project.user_id' => [
                'required',
                'integer',
                'exists:users,id'
            ]
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => Str::lower(__('projects.attributes.name')),
            'user_id' => Str::lower(__('projects.attributes.manager')),
        ];
    }

    public function mount(Project $project, bool $editMode)
    {
        $this->project = $project;
        $this->editMode = $editMode;
    }

    public function render()
    {
        return view('livewire.projects.project-form');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        sleep(1);
        $this->validate();

        $project = $this->project;

        DB::transaction(function () use ($project) {
            $project->save();
        });

        $this->redirect(route('projects.show', [$project]));

        $this->notification()->success(
            $this->editMode
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            $description = $this->editMode
                ? __('projects.messages.successes.updated', ['name' => $this->project->name])
                : __('projects.messages.successes.stored', ['name' => $this->project->name])
        );
    }
}
