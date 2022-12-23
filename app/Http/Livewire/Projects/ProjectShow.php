<?php

namespace App\Http\Livewire\Projects;

use App\Models\Project;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use WireUi\Traits\Actions;

class ProjectShow extends Component
{
    use Actions;
    use AuthorizesRequests;

    public Project $project;

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function render()
    {
        return view('livewire.projects.project-show');
    }
}
