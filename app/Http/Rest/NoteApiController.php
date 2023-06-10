<?php

namespace App\Http\Rest;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteApiController extends Controller
{
    public function show(Note $note)
    {
        $noteData = Note::with('task:id,name', 'project:id,name')
            ->where('id', '=', $note->id)
            ->first();

        if (!$noteData) {
            return response()->json(['error' => 'Note not found'], 404);
        }

        $response = $noteData->toArray();
        $response['task_id'] = $noteData->task ? $noteData->task->id : null;
        $response['task_name'] = $noteData->task ? $noteData->task->name : null;
        $response['project_id'] = $noteData->project ? $noteData->project->id : null;
        $response['project_name'] = $noteData->project ? $noteData->project->name : null;

        unset($response['task']);
        unset($response['project']);

        return $response;
    }

    public function store(Request $request) {
        $note = new Note();
        $note->content = $request->input('content');
        $note->project_id = $request->input('project_id');
        $note->task_id = $request->input('task_id');
        $note->save();
        return response()->json($note);
    }

    public function update(Request $request, Note $note) {

        $note->content = $request->input('content');
        $note->project_id = $request->input('project_id');
        $note->task_id = $request->input('task_id');
        $note->save();
        return response()->json($note);
    }

    public function delete(Note $note) {
        $note->delete();
    }
}
