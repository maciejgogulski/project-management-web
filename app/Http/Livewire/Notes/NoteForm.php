<?php

namespace App\Http\Livewire\Notes;

use App\Models\Note;
use App\Models\TaskNote;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use WireUi\Traits\Actions;

class NoteForm extends Component
{
    use Actions;
    use AuthorizesRequests;

    public TaskNote $taskNote;
    public Note $projectNote;
    public bool $editMode;

    public function rules()
    {
        return [
            'content' => 'required'
        ];
    }

    public function validationAttributes()
    {
        return [
            'content' => Str::lower(__('notes.attributes.content')),
        ];
    }

    public function mount(Note $projectNote, TaskNote $taskNote, bool $editMode)
    {
        $this->taskNote = $taskNote;
        $this->projectNote = $projectNote;
        $this->editMode = $editMode;
    }

    public function render()
    {
        return view('livewire.notes.note-form');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        sleep(1);
        $this->validate();

        if(isset($projectNote)) {
            $projectNote = $this->projectNote;

            DB::transaction(function () use ($projectNote) {
                $projectNote->save();
            });
        }

        if(isset($taskNote)) {
            $taskNote = $this->taskNote;

            DB::transaction(function () use ($taskNote) {
                $taskNote->save();
            });
        }

        $this->notification()->success(
            $this->editMode
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            $description = $this->editMode
                ? __('notes.messages.successes.updated')
                : __('notes.messages.successes.stored')
        );
    }
}
