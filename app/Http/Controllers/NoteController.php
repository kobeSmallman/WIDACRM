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
    // Define validation rules
    $validatedData = $request->validate([
        'Client_id' => 'required|exists:Client,Client_ID', // Ensure the client exists
        'Interaction_type' => 'required|string|max:50',
        'Created_by' => 'required|exists:Employee,Employee_ID', // Ensure the employee exists
        'Date_time' => 'required|date',
        'Description' => 'required|string|max:255', // If you expect a longer text, adjust the max value accordingly
        // 'image' validation is handled separately
    ]);

    // Continue with the note creation as before
    $note = new Note();
    $note->client_id = $validatedData['Client_id'];
    $note->interaction_type = $validatedData['Interaction_type'];
    $note->created_by = $validatedData['Created_by'];
    $note->date_time = $validatedData['Date_time'];
    $note->description = $validatedData['Description'];

    // Handle image upload
    // if ($request->hasFile('Image')) {
    //     // Adding validation for the image file
    //     $validatedData = $request->validate([
    //         'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image should be a valid image file and not more than 2MB
    //     ]);
    //     $path = $request->file('image')->store('public/notes');
    //     $note->image = $path;
    // }

    $note->save();

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
