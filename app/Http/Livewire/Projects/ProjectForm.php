<?php

namespace App\Http\Livewire\Projects;

use App\Models\Project;
use Illuminate\Support\Str;
use Livewire\Component;
use WireUi\Traits\Actions;

class ProjectForm extends Component
{
    use Actions;

    public Project $project;
    public bool $editMode;

    public function rules()
    {
        return [
            'project.name' => [
                'required',
                'string',
                'min:2'
            ]
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => Str::lower(__('projects.attributes.name'))
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
        $this->project->save();
        $this->notification()->success(
            $this->editMode
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            $description = $this->editMode
                ? __('projects.messages.successes.updated', ['name' => $this->project->name])
                : __('projects.messages.successes.stored', ['name' => $this->project->name])
        );
        $this->editMode = true;
    }
}
