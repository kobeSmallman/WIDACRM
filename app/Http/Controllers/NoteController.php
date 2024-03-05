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
        // Fetch all clients
        $clients = Client::all();

        return view('notes.takeNotes', compact('clients'));
    }

    public function store(Request $request)
    {
        // Validate the request fields
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,Client_ID',
            'interaction_type' => 'required|string|max:50', // Adjust the max value based on your column's definition
            'created_by' => 'required|exists:employees,Employee_ID',
            'date_time' => 'required|date',
            'description' => 'required|string|max:255',
        ]);

        // Create and save the note
        $note = new Note($validatedData);
        $note->save();

        return response()->json(['note_id' => $note->id], 200);
    }

    public function getCompanyInfo($id)
    {
        $client = Client::findOrFail($id);
        return response()->json([
            'companyName' => $client->Company_Name,
            'mainContact' => $client->Main_Contact,
            'email' => $client->Email,
            'phone' => $client->Phone_Number,
            // Consider including the client's ID or other relevant information if needed.
        ]);
    }

    public function edit(Note $note)
    {
        // This will return the note information as JSON, which can be used to populate an edit form on the front-end.
        return response()->json($note);
    }

    public function update(Request $request, Note $note)
    {
        // Validate the request data. Assuming 'interaction_type' is a string and doesn't need to be checked against specific values.
        $validatedData = $request->validate([
            'interaction_type' => 'required|string|max:50', // Adjust the max value based on your column's definition
            'date_time' => 'required|date',
            'description' => 'required|string|max:255', // Match the length to your database schema.
        ]);

        // Update the note with the validated data.
        $note->update($validatedData);

        // Return a successful response, perhaps with the updated note data.
        return response()->json(['message' => 'Note updated successfully.', 'note' => $note]);
    }

    // Consider adding methods to fetch notes for a client if not already implemented elsewhere.
}
