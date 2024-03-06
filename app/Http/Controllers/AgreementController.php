<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgreementController extends Controller
{
    public function show()
    {
        return view('Agreement.SoSAgreement');
    }
}
