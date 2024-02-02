<?php
namespace App\Http\Controllers;
 

class OrderSummaryController extends Controller
{
    public function index()
    {
        return view('OrderSummary.index');
    }

}
