<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class NoteController extends Controller
{
    public function create()
    {
        // Fetch all clients and pass them to the view
        $clients = Client::all();
        return view('notes.takeNotes', compact('clients'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'note' => 'required|string|max:1000',
            'date' => 'required|date',
        ]);

        // Create a new note and save it
        $note = new Note;
        $note->client_id = $validatedData['client_id'];
        $note->content = $validatedData['note'];
        $note->note_date = $validatedData['date'];
        $note->save();

        // Redirect to notes index with a success message
        return redirect()->route('notes.index')->with('success', 'Note added successfully.');
    }

    public static function list(): View {
        $notes = DB::select('select * from Notes');

        return view('notes.listNotes', ['notes' => $notes]);
    }

    // ... Other methods you may have in this controller
}
