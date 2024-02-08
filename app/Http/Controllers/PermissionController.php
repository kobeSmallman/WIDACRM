<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    
    public function index()
{
    $pages = Page::with(['permissions.employee'])->get();
    return view('permissions.permissionsPage', compact('pages'));
}
}

