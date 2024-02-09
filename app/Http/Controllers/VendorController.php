<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        // Fetch all vendors from the database
        $vendors = Vendor::all();

        // Return the vendors view and pass the vendors data to it
        return view('vendors.vendors', compact('vendors'));
    }

    // You can add more methods as needed for create, store, edit, update, delete operations
    // ...
}
