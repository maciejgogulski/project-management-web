<?php

namespace App\Http\Livewire\Notes;

use App\Models\Project;
use App\Models\ProjectNote;
use App\Models\TaskNote;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use WireUi\Traits\Actions;

// Uniwersalny komponent, który wyświetla zawartość lub jest formularzem dla notatki projektu i notatki zadania.
class NoteShow extends Component
{
    use Actions;
    use AuthorizesRequests;

    public ProjectNote $projectNote;
    public Project $project;
    public TaskNote $taskNote;
    public bool $editMode;
    public bool $createMode;

    public function rules()
    {
        return [
            'projectNote.content' => [
                'required',
                'string',
                'min:2'
            ],
        ];
    }

    public function mount(ProjectNote $projectNote, Project $project, $editMode = false, $createMode = false)
    {
        $this->project = $project;
        $this->projectNote = $projectNote;
        $this->createMode = $createMode;
        $this->editMode = $editMode;
    }

    public function toggleEditMode(){
        $this->editMode = !$this->editMode;
    }

    public function render()
    {
        return view('livewire.notes.note-show');
    }

    public function validationAttributes()
    {
        return [
            'content' => Str::lower(__('notes.attributes.content')),
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        sleep(1);
        $this->validate();

        $projectNote = $this->projectNote;

        if($this->createMode) {
            $projectNote->project_id = $this->project->id;
        }

        DB::transaction(function () use ($projectNote) {
            $projectNote->save();
        });

        if($this->createMode) {
            $this->redirect(route('projects.show', [$this->project]));
        }

        $this->notification()->success(
            $this->editMode
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            $description = $this->editMode
                ? __('notes.messages.successes.updated')
                : __('notes.messages.successes.stored')
        );

        $this->createMode = false;
        $this->editMode = false;
    }
}
