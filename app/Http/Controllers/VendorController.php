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
        return view('vendors.createVendor');
    }
    public function store(Request $request)
    {
        // Validate the request and add new vendor
        $validatedData = $request->validate([
            'Vendor_Name' => 'required|string|max:255',
            'Active_Status' => 'required|string|max:20',
            'Remarks' => 'nullable|string|max:255',
            'Email' => 'nullable|string|email|max:255',
            'PhoneNumber' => 'nullable|string|regex:/^\(\d{3}\) \d{3}-\d{4}$/',
        ]);
        //added this part -van 
       
        try{ 
           // Vendor::create($validatedData);
           if (!empty($validatedData['Vendor_Name'])) {
            $vendor = new Vendor();
          //  $vendor->Vendor_Name= $request->Vendor_Name;
           // $vendor->Active_Status = $request->Active_Status;
           // $vendor->Remarks = $request->Remarks;
           // $vendor->Email = $request->Email ;
           // $vendor->PhoneNumber= $request-> PhoneNumber;

           $vendor->Vendor_Name = $validatedData['Vendor_Name'];
            $vendor->Active_Status = $validatedData['Active_Status'];
            $vendor->Remarks = $validatedData['Remarks'];
            $vendor->Email = $validatedData['Email'];
            $vendor->PhoneNumber = $validatedData['PhoneNumber'];
            
            $vendor->save();

            return redirect()->route('vendors.index')->with('success', 'Vendor added successfully.');
           } else {
            return back()->withErrors('Vendor Name cannot be empty.')->withInput();
           }      
        } catch (\Exception $e){
            \Log::error($e->getMessage());
            return back()->withErrors('Failed to add vendor: '. $e->getMessage())->withInput();
        }
        //added this part -van 
    }

    public function edit($id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('vendors.editVendor', compact('vendor'));
    }
    
    public function update(Request $request, $id)
    {
        // Validate the request with all necessary fields
        $validatedData = $request->validate([
            'Vendor_Name' => 'required|string|max:255',
            'Active_Status' => 'required|in:1,0', // Ensure Active_Status is either '1' or '0'
            'Remarks' => 'nullable|string|max:255',
            'Email' => 'nullable|email|max:255',
            'PhoneNumber' => 'nullable|string|max:255',
        ]);
        
        try {
            // Find the vendor and update it with the validated data
            $vendor = Vendor::findOrFail($id);
            $vendor->update($validatedData);
    
            return redirect()->route('vendors.index')->with('success', 'Vendor updated successfully.');
        } catch (\Exception $e) {
            // Log the exception and return with an error
            \Log::error($e->getMessage());
            return back()->withErrors('Failed to update vendor: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            // Find the vendor and delete it
            $vendor = Vendor::findOrFail($id);
            $vendor->delete();
            
            return redirect()->route('vendors.index')->with('success', 'Vendor deleted successfully.');
        } catch (\Exception $e) {
            // Log the exception and return with an error
            \Log::error($e->getMessage());
            return back()->withErrors('Failed to delete vendor: ' . $e->getMessage());
        }
    }

    // Add any other methods you need for the controller
}
