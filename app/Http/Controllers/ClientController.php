<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends BaseController
{
       /**
     * Displays a list of all clients.
     * Retrieves all client records from the database and passes them to the 'clients.index' view for display.
     */
    public function index()
    {
        $clients = Client::all(); 
        return view('clients.index', compact('clients'));
    }
    /**
     * Displays the form to add a new client.
     * Returns the 'clients.add-client' view which contains the form for entering new client data.
     */
    public function addClient()
    { 
        return view('clients.add-client'); 
    }
 /**
     * Displays the client editing form pre-filled with client data.
     * Fetches a client based on the provided ID, retrieves their order history,
     * and returns the 'clients.client-info' view with this data.
     */
    public function editClient($clientID)
    { 

        $selectedClient = Client::findOrFail($clientID); 
        $orderHistory = $selectedClient->orders()->latest('Request_Date')->get(); 
        return view('clients.client-info', compact('selectedClient', 'orderHistory')); 
    }
 /**
     * Handles the submission of the client update form.
     * Validates the request data, updates the client record in the database,
     * and redirects back with a success message or logs an error and returns with an error message.
     */
    public function update(Request $request, $id)
    {   
        $client = Client::findOrFail($id);
        $validatedData = $request->validate([ 
            'Main_Contact' => 'required|string|max:255',
            'Lead_Status' => 'required|string|max:10',
            'Buyer_Status' => 'required|string|max:10',
            'Shipping_Address' => 'required|string|max:255',
            'Billing_Address' => 'required|string|max:255',
            'Phone_Number' => 'required|string|regex:/^\(\d{3}\) \d{3}-\d{4}$/',
            'Email' => 'required|string|email|max:255',
            'Remarks' => 'nullable|string|max:255',
            'Secondary_Contact'=> 'nullable|string|max:255',
            'Secondary_Email'=>'nullable|string|email|max:255',
            'Secondary_Phone'=> 'nullable|string|max:20',
        ]);
        try {
            $client->update($validatedData);  
            return redirect()->route('clients.editClient', compact('client'))->with('success', 'Client updated successfully.');

        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return back()->withErrors('Failed to update client: ' . $e->getMessage())->withInput();
        }
    }
    
 /**
     * Handles the submission of the new client form.
     * Validates the request data, sets the 'Created_By' to the authenticated user's ID,
     * creates a new client record, and redirects or returns an error message.
     */
    public function saveClient(Request $request)
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
            'Remarks' => 'nullable|string|max:255',
            'Secondary_Contact'=> 'nullable|string|max:255',
            'Secondary_Email'=>'nullable|string|email|max:255',
            'Secondary_Phone'=> 'nullable|string|max:20',
        ]);
    
        // Set the 'Created_By' to the ID of the authenticated user
        $validatedData['Created_By'] = Auth::id(); 
    
        try {
            Client::create($validatedData);
            return redirect()->route('clients')->with('success', 'Client added successfully.'); 
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            //return back()->withErrors('Failed to add client: ' . $e->getMessage())->withInput();
            return redirect()->route('clients')->with('error', $e->getMessage()); 
        }
    }
/**
     * Handles the deletion of a client.
     * Checks if the client has any orders or notes and returns an error if they do.
     * If no related records are found, it deletes the client and redirects with a success message.
     */
    public function deleteClient($id)
    { 
        $client = Client::findOrFail($id); 
        $hasOrders = $client->orders()->exists();
        if ($hasOrders) {
            return redirect()->route('clients')->with('error', 'Cannot delete client with existing orders.');
        } 

        $hasNotes = $client->Notes()->exists(); 
        if ($hasNotes) {
            return redirect()->route('clients')->with('error', 'Cannot delete client with existing notes.');
        } 
        
        $client->delete(); 
        return redirect()->route('clients')->with('success', 'Client deleted successfully.'); 
    }
    

}

