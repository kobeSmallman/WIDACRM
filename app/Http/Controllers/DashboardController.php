<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the dashboard display logic and redirect to the appropriate dashboard.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        // Assuming you have a method on your User model to check if the user is an admin
        if (Auth::check() && Auth::user()->isAdmin()) {
            return $this->adminDashboard();
        } else {
            return $this->employeeDashboard();
        }
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
        public function adminDashboard()
    {
        // Fetch clients with the notes and employees who interacted with them
        $clients = Client::with(['notes', 'notes.employee'])->get();

        return view('dashboard.admin', compact('clients'));
    }


    /**
     * Show the employee dashboard.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function employeeDashboard()
    {
        // Logic for employee dashboard view
        return view('dashboard.employee');
    }
    
    // Add any other methods you need for your controller here
}
