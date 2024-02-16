<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; // Add this line to use AuthController
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\RequestController; // Ensure you have this controller created
use App\Http\Controllers\VendorController;
use App\Http\Controllers\OrderController;


// ... other routes ...



// ... other routes ...

// ...





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Login routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Dashboard routes
Route::get('/dashboard/admin', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
Route::get('/dashboard/employee', [DashboardController::class, 'employeeDashboard'])->name('employee.dashboard');

//client routes
Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
Route::get('/clients/{id}', [ClientController::class, 'show'])->name('clients.show');
Route::post('/clients/store', [ClientController::class, 'store'])->name('clients.store');
Route::get('/clients/{id}/notes', [ClientController::class, 'show'])->name('clients.notes');
Route::get('/clients/{id}/notes', [ClientController::class, 'notes'])->name('clients.notes');
// web.php
Route::get('/clients/{id}/orders', [ClientController::class, 'getClientOrders'])->name('clients.orders');


// Add a route to fetch all orders for all clients
Route::get('/orders/all', [OrderController::class, 'getAllOrders'])->name('orders.all');

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
// Route to store a new order
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
// Vendor routes
Route::get('/vendors', [VendorController::class, 'index'])->name('vendors.index');
Route::resource('vendors', VendorController::class);
// Place these inside the web.php file
Route::get('/vendors', [VendorController::class, 'index'])->name('vendors.index');

// Edit vendor form
Route::get('/vendors/{vendor}/edit', [VendorController::class, 'edit'])->name('vendors.edit');

// Update vendor
Route::put('/vendors/{vendor}', [VendorController::class, 'update'])->name('vendors.update');

// Delete vendor
Route::delete('/vendors/{vendor}', [VendorController::class, 'destroy'])->name('vendors.destroy');

//system users route
Route::get('/system-users', [AuthController::class, 'showSystemUsers'])->name('system-users');
Route::post('/employees/store', [AuthController::class, 'store'])->name('employees.store');
// Place this inside the web routes in web.php
Route::post('/employees/create', [AuthController::class, 'storeEmployee'])->name('employees.create');

//Employee profile page route
Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
Route::get('/profile/{employee}', [AuthController::class, 'showProfile'])->name('profile');

// Report routes
Route::get('/ordersummary', [OrderSummaryController::class, 'index'])->name('ordersummary.index');
Route::get('/clientsummary', [ClientSummaryController::class, 'index'])->name('clientsummary.index');
Route::get('/vendorsummary', [VendorSummaryController::class, 'index'])->name('vendorsummary.index');

// Display the page to take notes with a list of clients
// Route::get('/takeNotes', [NoteController::class, 'create'])->name('takeNotes');

// Store the notes into the database
// Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');

// Display the page to create a new request based on the selected client
// This assumes you have a separate RequestController for handling requests
//notes page
// Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create');
// Route::post('/notes/store', [NoteController::class, 'store'])->name('notes.store');
Route::get('/notes', [NotesOverviewController::class, 'list'])->name('notes.list');

//request page
// Define a route for the createRequest view

Route::get('/create-request', [RequestController::class, 'createRequest'])->name('createRequest');
Route::get('/requests', [RequestController::class, 'index'])->name('requests.index');
Route::get('/requests/create', [RequestController::class, 'create'])->name('requests.create');
Route::post('/requests', [RequestController::class, 'store'])->name('requests.store');
Route::get('/requests/{request}', [RequestController::class, 'show'])->name('requests.show');
Route::get('/requests/{request}/edit', [RequestController::class, 'edit'])->name('requests.edit');
Route::put('/requests/{request}', [RequestController::class, 'update'])->name('requests.update');
Route::delete('/requests/{request}', [RequestController::class, 'destroy'])->name('requests.destroy');




Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions');


Route::get('/settings', [SettingsController::class, 'index'])->name('site.settings');

Route::post('/settings/save-mode', [SettingsController::class, 'saveMode'])->name('settings.save-mode');






