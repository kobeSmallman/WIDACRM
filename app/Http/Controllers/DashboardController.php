<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function adminDashboard()
    {
        // Check if the user is authenticated and is an admin.
        if (Auth::check() && Auth::user()->isAdmin()) {
            return view('dashboard.admin');
        }

        // If the user is not an admin or not authenticated, redirect them to the login page.
        return redirect()->route('login.form');
    }

    /**
     * Show the employee dashboard.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function employeeDashboard()
    {
        if (Auth::check() && Auth::user()->isEmployee()) {
            // Add a log statement or use dd() to debug
            \Log::info('Redirecting to employee dashboard.');
            return view('dashboard.employee');
        }
    
        return redirect()->route('login.form');
    }
    
}
