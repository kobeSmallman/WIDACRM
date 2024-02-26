<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        // Eager load Orders and Products related to Clients for efficiency
        $clients = Client::all();
        $clients = Client::with(['orders.products'])->get();
        return view('clients.index', compact('clients'));
    }

    public function show($id)
    {
        // Load the client with notes and the employees who created them
        $client = Client::with(['notes.employee'])->findOrFail($id);

        if (request()->ajax()) {
            return response()->json($client);
        }

        // Return the appropriate view based on the route
        if (request()->routeIs('clients.show')) {
            return view('clients.show', compact('client'));
        } elseif (request()->routeIs('clients.notes')) {
            return view('notes.index', compact('client'));
        }

        abort(404, 'Page not found.');
    }
    public function notesAJAX($id)
    {
        $client = Client::with('notes')->findOrFail($id);
        return response()->json($client->notes);
    }

    public function lastOrders($id)
    {
        $client = Client::with(['orders' => function ($query) {
            $query->latest('Request_DATE')->take(5);
        }])->findOrFail($id);

        return response()->json($client->orders);
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
        ]);

        $validatedData['Created_By'] = Auth::id();

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
        $clients = Client::with('employee')->get();
        return view('dashboard.admin', compact('clients'));
    }

    public function createRequest()
    {
        $clients = Client::all();
        return view('createRequest', compact('clients'));
    }

    // Ensure you have routes set up for these methods in your web.php file
}
