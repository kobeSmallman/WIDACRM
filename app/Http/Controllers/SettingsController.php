<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings.siteSettings');
    }
    public function saveMode(Request $request)
{
    // Save the dark mode preference in the session
    $request->session()->put('dark_mode', $request->input('dark_mode'));
    return response()->noContent();
}

}
