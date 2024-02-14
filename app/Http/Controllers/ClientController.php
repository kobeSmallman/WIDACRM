<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Add this line to use the Auth facade

class ClientController extends Controller
{
    
    public function index()
    {
        $clients = Client::all();
        $clients = Client::with(['Orders.Products'])->get();
        return view('clients.index', compact('clients'));
    }
    
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
    
    public function notes($id)
{
    $client = Client::with('notes.employee')->findOrFail($id);
    return view('notes.index', compact('client'));
}




public function store(Request $request)
{
    $validatedData = $request->validate([
        'Company_Name' => 'required|string|max:255',
        'Main_Contact' => 'required|string|max:255',
        'Lead_Status' => 'required|string|max:10',
        'Buyer_Status' => 'required|string|max:10',
        'Shipping_Address' => 'required|string|max:255',
        'Billing_Address' => 'required|string|max:255',
        'Phone_Number' => 'required|string|max:20',
        'Email' => 'required|string|email|max:255',
        // ...other validation rules
    ]);

    // Set the 'Created_By' to the ID of the authenticated user
    $validatedData['Created_By'] = Auth::id(); // or Auth::user()->Employee_ID if you have 'Employee_ID' column in your users table

    try {
        Client::create($validatedData);
        return redirect()->route('clients.index')->with('success', 'Client added successfully.');
    } catch (\Exception $e) {
        \Log::error($e->getMessage());
        return back()->withErrors('Failed to add client: ' . $e->getMessage())->withInput();
    }
}



    public function adminDashboard()
{
    // Fetch clients with the employee who interacted with them
    $clients = Client::with('employee')->get();

    return view('dashboard.admin', compact('clients'));
}

public function createRequest()
{
    // Fetch all clients
    $clients = Client::all(); // Assuming you want to list all clients in the dropdown

    // Pass the clients to your view
    return view('createRequest', compact('clients'));
}

    // Add any other necessary methods here
}
