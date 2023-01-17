<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProjectList extends Component
{
    public $projects;

    protected $listeners = [
        'refreshComponent' => '$refresh',
    ];

    public function mount()
    {
        $this->projects = Project::query()
            ->where('user_id', '=', Auth::user()->id)
        ->get();
    }

    public function render()
    {
        return view('livewire.dashboard.project-list');
    }
}
