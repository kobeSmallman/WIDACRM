<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgreementController extends Controller
{
    public function show()
    {
        return view('Agreement.SoSAgreement');
    }
    public function create()
    {
        return view('Agreement.SoSAgreement');
    }

    public function store(Request $request)
    {
    // Validate and store the agreement form data
    // Redirect or return a view as needed
    }
}

