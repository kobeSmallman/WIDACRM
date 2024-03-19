<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends BaseController
{
    
    public function index()
    {
        $clients = Client::all(); 
        return view('clients.index', compact('clients'));
    }
    public function addClient()
    { 
        return view('clients.add-client'); 
    }

    public function editClient($clientID)
    { 

        $selectedClient = Client::findOrFail($clientID); 
        $orderHistory = $selectedClient->orders()->latest('Request_Date')->get(); 
        return view('clients.client-info', compact('selectedClient', 'orderHistory')); 
    }

    public function update(Request $request, $id)
    { 
        $client = Client::findOrFail($id);
         
        $client->update($request->all());
 
        return redirect()->route('clients.editClient', compact('client')); 
    }
    

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
        ]);
    
        // Set the 'Created_By' to the ID of the authenticated user
        $validatedData['Created_By'] = Auth::id(); 
    
        try {
            Client::create($validatedData);
            return redirect()->route('clients')->with('success', 'Client added successfully.');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return back()->withErrors('Failed to add client: ' . $e->getMessage())->withInput();
        }
    }

    public function deleteClient($id)
    { 
        $client = Client::findOrFail($id); 
        $client->delete();
 
        return redirect()->route('clients')->with('success', 'Client deleted successfully.');
    }
     
}

