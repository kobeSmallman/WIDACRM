<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Client;
use App\Models\Image;
use App\Http\Controllers\ImageController;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
    

    // Continue with the note creation as before
    $note = new Note();
   
    $note->Client_ID = $request->get('Client_ID');
    $note->Interaction_Type = $request->get('Interaction_Type');
    $note->Created_By = $request->get('Created_By');
    $note->Description = $request->get('Description');

    $note->save();

    // Uploading an image
    if ($request->hasFile('images')) {
        $imageController = new ImageController();
        return $imageController->store($request, $note); // Pass the note ID to the image store method
    }


    // Return a JSON response
    return response()->json(['success' => true, 'message' => 'Note saved successfully']);
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
