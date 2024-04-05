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
            'Title' => $request->Title,
        ]);
        
        return response()->json(['success' => true, 'message' => 'Note saved successfully, note controller', 'noteId' => $note->Note_ID]);
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

     /// FUNCTIONS USED BY NOTES CONTROLLER
    public function show($id)
    {
        // Load the client along with the notes and the employees who created them
        $client = Client::with(['notes', 'notes.employee'])->findOrFail($id);
    
        // If it's an AJAX request, return JSON data
        if (request()->ajax()) {
            return response()->json($client);
        }
        
        // Determine which view to return based on the current route
        if (request()->routeIs('clients.show')) {
            // If the current route is 'clients.show'
            return view('clients.show', compact('client'));
        } elseif (request()->routeIs('clients.notes')) {
            // If the current route is 'clients.notes'
            return view('notes.index', compact('client'));
        }
    
        // Optional: handle the case where neither route matches
        abort(404, 'Page not found.');
    }
    
    public function notesAJAX($id)
    {
        $client = Client::with('notes')->findOrFail($id);
        return response()->json($client->notes);
    }



    public function notes($id)
    {
        $client = Client::with('notes.employee')->findOrFail($id);
        return view('notes.index', compact('client'));
    }

    public function notesCount($id)
    {
        $client = Client::findOrFail($id);
        $notesCount = $client->notes->count();
        return response()->json($notesCount);
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
