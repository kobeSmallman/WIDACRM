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

// Web.php
use App\Http\Controllers\AnalyticsController;
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
// web.php

Route::get('/tab-content/showcaseOne', function () {
    return view('dashboard.adminDashboardShowcaseOne');
})->name('tabs.showcaseOne');

Route::get('/tab-content/showcaseTwo', function () {
    return view('dashboard.adminDashboardShowcaseTwo');
})->name('tabs.showcaseTwo');

Route::get('/tab-content/showcaseThree', function () {
    return view('dashboard.adminDashboardShowcaseThree');
})->name('tabs.showcaseThree');

Route::get('/analytics/renewals', [AnalyticsController::class, 'getRenewalsData'])->name('analytics.renewals');
Route::get('/analytics/communication-frequency', [AnalyticsController::class, 'getCommunicationFrequencyData'])->name('analytics.communicationFrequency');
Route::get('/analytics/interaction-timeline', [AnalyticsController::class, 'getInteractionTimelineData'])->name('analytics.interactionTimeline');

Route::get('/dashboard/employee', [DashboardController::class, 'employeeDashboard'])->name('employee.dashboard');

//client routes
Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
Route::get('/clients/{id}', [ClientController::class, 'show'])->name('clients.show');
Route::post('/clients/store', [ClientController::class, 'store'])->name('clients.store');
Route::get('/clients/{clientId}/orders', [ClientController::class, 'getClientOrders']);
Route::get('/clients/{id}/orders', [ClientController::class, 'getClientOrders'])->name('clients.orders');

// Notes
Route::get('/clients/{id}/notes', [ClientController::class, 'notes'])->name('clients.notes');
Route::get('/clients/{id}/notesCount', [ClientController::class, 'notesCount'])->name('clients.notesCount');
Route::get('/clients/{id}/last-orders', [ClientController::class, 'lastOrders'])->name('clients.lastOrders');


// Add a route to fetch all orders for all clients
// Display a listing of the orders
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

// Show the form for creating a new order
Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');

// Store a newly created order in storage
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

// Display the specified order
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

// Show the form for editing the specified order
Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');

// Update the specified order in storage
Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');

// Remove the specified order from storage
Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');

// You might want to add a route for fetching all orders or specific order details for AJAX calls
Route::get('/orders/all', [OrderController::class, 'getAllOrders'])->name('orders.all');

Route::get('/orders/details/{orderId}', [OrderController::class, 'getOrderDetails'])->name('orders.details');

// Update an existing order (this could be used for the edit functionality)
Route::post('/orders/update/{orderId}', [OrderController::class, 'update'])->name('orders.update');

// Route to fetch orders for a specific client
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

// (NOTES) Display the page to take notes with a list of clients ||||| Notes page
Route::get('/takeNotes', [NoteController::class, 'create'])->name('notes.create');
Route::get('/get-company-info/{id}', [NoteController::class, 'getCompanyInfo'])->name('getCompanyInfo');
Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
Route::get('/clients/{id}/notesAJAX', [ClientController::class, 'notesAJAX'])->name('clients.notesAJAX');
// Route to show the form for editing a specific note
Route::get('/notes/{note}/edit', [NoteController::class, 'edit'])->name('notes.edit');
// Route to update a specific note
Route::patch('/notes/{note}', [NoteController::class, 'update'])->name('notes.update');

// Display the page to create a new request based on the selected client
// This assumes you have a separate RequestController for handling requests
//notes page
Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create');
Route::post('/notes/store', [NoteController::class, 'store'])->name('notes.store');
//request page
// Define a route for the createRequest view




Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions');


Route::get('/settings', [SettingsController::class, 'index'])->name('site.settings');

Route::post('/settings/save-mode', [SettingsController::class, 'saveMode'])->name('settings.save-mode');
