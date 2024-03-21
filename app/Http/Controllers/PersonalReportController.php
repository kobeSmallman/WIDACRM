<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonalReportController extends Controller
{
    public function index()
    {
        // Return the view for the personal sales report
        return view('reports.salesByEmployeePersonal');
    }
}

