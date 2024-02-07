<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Product;
use App\Models\CustomRequest; // Ensure CustomRequest model exists at this path.

class RequestController extends Controller
{
    public function index()
    {
        $requests = CustomRequest::all();
        return view('requests.index', compact('requests'));
    }

    public function createRequest()
    {
        $clients = Client::all();
        $products = Product::all();
        return view('requests.createRequest', compact('clients', 'products'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'product_id' => 'required|exists:products,id',
            // Add other validation rules as necessary
        ]);

        $newRequest = new CustomRequest($validatedData);
        $newRequest->save();

        return redirect()->route('requests.index')->with('success', 'Request created successfully.');
    }

    public function show(CustomRequest $request)
    {
        return view('requests.show', compact('request'));
    }

    public function edit(CustomRequest $request)
    {
        $clients = Client::all();
        $products = Product::all();
        return view('requests.edit', compact('request', 'clients', 'products'));
    }

    public function update(Request $request, CustomRequest $customRequest)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'product_id' => 'required|exists:products,id',
            // Add other validation rules as necessary
        ]);

        $customRequest->update($validatedData);

        return redirect()->route('requests.index')->with('success', 'Request updated successfully.');
    }

    public function destroy(CustomRequest $request)
    {
        $request->delete();
        return redirect()->route('requests.index')->with('success', 'Request deleted successfully.');
    }

    // Add other methods as needed
}
