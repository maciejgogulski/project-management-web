<?php

namespace App\Http\Livewire\Notes;

use App\Models\Project;
use App\Models\Note;
use App\Models\Task;
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

    public Note $note;
    public Project $project;
    public Task $task;
    public bool $editMode;
    public bool $createMode;

    protected $listeners = [
        'refreshNote' => '$refresh'
    ];

    public function rules()
    {
        return [
            'note.content' => [
                'required',
                'string',
                'min:2'
            ],
        ];
    }

    public function mount(Note $note, Project $project = null, Task $task = null, $editMode = false, $createMode = false)
    {
        $this->project = $project;
        $this->task = $task;
        $this->note = $note;
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

        $note = $this->note;

        if($this->createMode) {
            if(isset($this->project)) {
                $note->project_id = $this->project->id;
            }

            if(isset($this->task)) {
                $note->task_id = $this->task->id;
            }
        }

        DB::transaction(function () use ($note) {
            $note->save();
        });

        $this->notification()->success(
            $this->editMode
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            $description = $this->editMode
                ? __('notes.messages.successes.updated')
                : __('notes.messages.successes.stored')
        );

        if($this->createMode) {
            //unset($this->note);
            $this->emit('refreshNote');
            $this->emitUp('refreshNoteList');
        }

        $this->editMode = false;
    }
}
