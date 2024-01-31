<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

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
            'Created_By' => 'required|integer|max:11', // You may want to handle this internally, not via the form
            // Add any other fields as necessary
            //eat my balls TONY!
        ]);

        try {
            Client::create($validatedData);
            return redirect()->route('clients.index')->with('success', 'Client added successfully.');
        } catch (\Exception $e) {
            // Log the error
            \Log::error($e->getMessage());
            // Redirect back with an error message
            return back()->withErrors('Failed to add client: ' . $e->getMessage())->withInput();
        }
    }
    public function adminDashboard()
{
    // Fetch clients with the employee who interacted with them
    $clients = Client::with('employee')->get();

    return view('dashboard.admin', compact('clients'));
}



    // Add any other necessary methods here
}
