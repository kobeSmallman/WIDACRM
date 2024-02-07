<?php
namespace App\Http\Controllers;
 

class ClientSummaryController extends Controller
{
    public function index()
    {


        // check permissions

        // if with access return view, if now return access denied page

        // if full access, load all modify controls, else disable

        
        return view('ClientSummary.index');
    }

}
