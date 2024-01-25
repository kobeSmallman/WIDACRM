<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    public function show($id)
    {
        $client = Client::findOrFail($id);
        return view('clients.show', compact('client'));
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

    // Add any other necessary methods here
}
