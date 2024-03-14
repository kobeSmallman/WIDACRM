<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;// Add this line to use the Auth facade

class VendorController extends Controller
{
    public function index()
    {
        // Fetch all vendors from the database
        $vendors = Vendor::all();
        return view('vendors.vendors', compact('vendors'));
    }

    public function create()
    {
        // Return the view to create a new vendor
        return view('vendors.create');
    }

    public function store(Request $request)
    {
        // Validate the request and add new vendor
        $validatedData = $request->validate([
            'Vendor_Name' => 'required|string|max:255',
            'Active_Status' => 'required|string|max:20',
            'Remarks' => 'nullable|string|max:255',
            'Email' => 'nullable|string|max:255',
            'PhoneNumber' => 'nullable|string|max:255',
        ]);
        //added this part -van 
       
        try{ 
            Vendor::create($validatedData);
            return redirect()->route('vendors.index')->with('success', 'Vendor add  ed successfully.');
        } catch (\Exception $e){
            \Log::error($e->getMessage());
            return back()->withErrors('Failed to add vendor: '. $e->getMessage())->withInput();
        }
        //added this part -van 
    }

    public function edit($id)
    {
        // Find the vendor by ID and return the edit view
        $vendor = Vendor::findOrFail($id);
        return view('vendors.edit', compact('vendor'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request and update the vendor
        $validatedData = $request->validate([
            'Vendor_Name' => 'required|string|max:255',
            'Active_Status' => 'required|string|max:20',
            'Remarks' => 'nullable|string|max:255',
        ]);
        
        $vendor = Vendor::findOrFail($id);
        $vendor->update($validatedData);
        return redirect()->route('vendors.index')->with('success', 'Vendor updated successfully.');
    }

    public function destroyVendor($id)
    {
        // Delete the vendor
        $vendor = Vendor::findOrFail($id);
        $vendor->delete();
        return redirect()->route('vendors.index')->with('success', 'Vendor deleted successfully.');
    }
    

    // Add any other methods you need for the controller
}
