<?php

namespace App\Http\Livewire\Notes;

use App\Models\Project;
use App\Models\Task;
use Livewire\Component;

class NoteList extends Component
{
    public Project $project;
    public Task $task;

    protected $listeners = [
        'refreshNoteList' => '$refresh',
    ];

    public function mount(Project $project, Task $task)
    {
        $this->task = $task;
        $this->project = $project;
    }

    public function render()
    {
        return view('livewire.notes.note-list');
    }

}
