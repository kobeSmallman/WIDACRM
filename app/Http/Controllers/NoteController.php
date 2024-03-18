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
        $note = Note::create([

            'Client_ID' => $request->Client_ID,
            'Interaction_Type' => $request->Interaction_Type,
            'Created_By' => $request->Created_By,
            'Description' => $request->Description,
        ]);
        //$note->save();

        // // Uploading an image
        // if ($request->hasFile('images')) {
        //     $imageController = new ImageController();
        //     $imageController->store($request, $note->id); // Pass the note ID to the image store method
        // }

        //code with Tony youtube
        if ($request->hasFile('images')) {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $folder = uniqid('image-', true);
            $image->storeAs('images/tmp/'. $folder, $filename);

            $image = ImageController::create([
                'folder' => $folder,
                'file' => $filename
            ]);
            return$folder;
        }

        // Return a JSON response
        // NoteController.php
        return response()->json(['success' => true, 'message' => 'Note saved successfully', 'noteId' => $note->Note_ID]);
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

    public function lastOrders($id)
    {
        $client = Client::with(['orders' => function ($query) {
            $query->latest('Request_DATE')->take(5);
        }])->findOrFail($id);

        return response()->json($client->orders);
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
