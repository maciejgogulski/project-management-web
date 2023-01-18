<div class="collapse" id="collapseCreateNoteForm">
    <div class="block p-6 rounded-lg shadow-lg bg-white mb-5">
        <livewire:notes.note-show :createMode="true" :task="$task" :project="$project"/>
    </div>
</div>

<div class="collapse" id="collapseNotes">
    @if(isset($project))
        @foreach($project->notes as $note)
            <div class="block p-6 rounded-lg shadow-lg bg-white mb-5">
                <livewire:notes.note-show :note="$note"/>
            </div>
        @endforeach
    @endif

    @if(isset($task))
        @foreach($task->notes as $note)
            <div class="block p-6 rounded-lg shadow-lg bg-white mb-5">
                <livewire:notes.note-show :note="$note"/>
            </div>
        @endforeach
    @endif
</div>
