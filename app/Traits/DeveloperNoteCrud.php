<?php


namespace App\Traits;


use App\Models\DeveloperNote;
use Illuminate\Http\Request;

trait DeveloperNoteCrud
{
    private $path = 'default.pages.developerNote';

    // custom view return function with path
    private function cview($path, $compact = []) {
        $compact['path'] = $this->path;
        return view($this->path .'.'. $path, $compact);
    }

    public function editModal(DeveloperNote $note)
    {
        return $this->cview('modal.editModal', compact('note'));
    }

    public function updateNote(Request $request, $note_id)
    {
        $required = array_reduce($request->keys(), function($fields, $key) {
            $fields[$key] = 'required';
            return $fields;
        }, []);
        $request->validate($required);

        DeveloperNote::where('id', $note_id)->update($request->only('is_done', 'text', 'user_id'));
        return 'success';
    }

    public function deleteNote(DeveloperNote $note)
    {
        save_update($note, [
            'is_deleted' => 1, 'deleted_at' => date('Y-m-d H:i:s'),
            'userd_id' => auth()->id()
        ]);
        return 'success';
    }

    public function clientModal(DeveloperNote $note) {
        return $this->cview('modal.clientModal', compact('note'));
    }
}