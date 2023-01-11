<?php

namespace App\Http\Livewire\Notes;

use App\Models\Project;
use App\Models\ProjectNote;
use App\Models\Task;
use App\Models\TaskNote;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use WireUi\Traits\Actions;

class NoteShow extends Component
{
    use Actions;
    use AuthorizesRequests;

    public ProjectNote $projectNote;
    public TaskNote $taskNote;

    public function mount(ProjectNote $projectNote)
    {
        $this->projectNote = $projectNote;
    }

//    public function mount(TaskNote $taskNote)
//    {
//        $this->taskNote = $taskNote;
//    }

    public function render()
    {
        return view('livewire.notes.note-show');
    }
}
