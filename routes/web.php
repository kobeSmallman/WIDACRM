<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; // Add this line to use AuthController
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AgreementController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ClientSalesReportController;
use App\Http\Controllers\OrderVolumeReportController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\OrderStatusReportController;
use App\Http\Controllers\SalesByEmployeeReportController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ReportController;
// routes/web.php

use App\Http\Controllers\SalesByEmployeePersonalController;
;

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
Route::get('/access-denied', function () {
    return view('Errors.403');
})->name('access.denied');


 
    // Dashboard routes



    Route::get('/dashboard/admin', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    
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
    Route::get('/clients', [ClientController::class, 'index'])
        ->name('clients')
        ->middleware('checkAccess:Clients'); 
    Route::get('/clients/add-client', [ClientController::class, 'addClient'])
        ->name('clients.addClient')
        ->middleware('checkAccess:Clients');
    Route::post('/clients/save-client', [ClientController::class, 'saveClient'])
        ->name('clients.saveClient')
        ->middleware('checkAccess:Clients');
    Route::get('/clients/client-info/{client}', [ClientController::class, 'editClient'])
        ->name('clients.editClient')
        ->middleware('checkAccess:Clients');
    Route::post('/clients/{id}/update', [ClientController::class, 'update'])
        ->name('updateClient')
        ->middleware('checkAccess:Clients'); 
    Route::delete('/clients/{id}', [ClientController::class, 'deleteClient'])
        ->name('clients.deleteClient')
        ->middleware('checkAccess:Clients');

    //Permissions routes
    Route::get('/permissions', [PermissionController::class, 'index'])
        ->name('permissions')
        ->middleware('checkAccess:Permissions');
    Route::get('/permissions/employee-permission/{employee}', [PermissionController::class, 'editPermission'])
        ->name('permissions.edit')
        ->middleware('checkAccess:Permissions');
    Route::put('/permissions/employee-permission/update', [PermissionController::class, 'updatePermission'])
        ->name('permissions.update')
        ->middleware('checkAccess:Permissions'); 
    Route::delete('/permissions/employee-permission/{id}', [PermissionController::class, 'deletePermission'])
        ->name('permissions.delete')
        ->middleware('checkAccess:Permissions');
    Route::post('/permissions/employee-permission/save', [PermissionController::class, 'savePermission'])
        ->name('permissions.save')
        ->middleware('checkAccess:Permissions');

    // Notes
    Route::get('/clients/{id}/notes', [ClientController::class, 'notes'])->name('clients.notes');
    Route::get('/clients/{id}/notesCount', [ClientController::class, 'notesCount'])->name('clients.notesCount');
    



    // Add a route to fetch all orders for all clients

    // Display a listing of the orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    // Show the form for creating a new order
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');

    // Store a newly created order in storage
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

    // Display the specified order
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

    // Show the form for editing the specified order
    Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');

    // Update the specified order in storage
    Route::put('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');

    // Remove the specified order from storage
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');

    // Route to view order profile
    Route::get('/orderProfile/{id}', [OrderController::class, 'orderProfile'])->name('orderProfile');
    Route::get('/orders/{order}/profile', [OrderController::class, 'profile'])->name('orders.profile');
    // Routes for AJAX calls
    Route::get('/api/orders/{id}', [OrderController::class, 'showAjax'])->name('orders.showAjax');
    Route::get('/orders/all', [OrderController::class, 'getAllOrders'])->name('orders.all');
    Route::get('/orders/details/{orderId}', [OrderController::class, 'getOrderDetails'])->name('orders.details');
    Route::post('/save-order', 'OrderController@updateOrder');
// Existing order routes
Route::get('/orders/edit/{order}', [OrderController::class, 'edit'])->name('orders.edit');
Route::get('/order/{order}/edit-payment', [OrderController::class, 'editPayment'])->name('orders.editPayment');
Route::get('/order/{order}/add-payment', [OrderController::class, 'addPayment'])->name('orders.addPayment');

// Existing client route
Route::get('/clients/client-info/{client}', [ClientController::class, 'editClient'])->name('clients.editClient');


    // Make sure you have only one edit route and that the method is GET for showing the form
    // and PUT for submitting the form. Also, ensure the {id} placeholder matches the parameter
    // name in the controller method for the edit route.

    // Route to fetch orders for a specific client
    // Vendor routes

    Route::get('/vendors', [VendorController::class, 'index'])->name('vendors.index');
    Route::resource('vendors', VendorController::class);
    // Place these inside the web.php file
    Route::get('/vendors', [VendorController::class, 'index'])->name('vendors.index');

    //store route - Van
    Route::post('/vendors/store', [VendorController::class, 'store'])->name('vendors.store');

    // Edit vendor form
    Route::get('/vendors/{vendor}/edit', [VendorController::class, 'edit'])->name('vendors.edit');

    // Update vendor
    Route::put('/vendors/{vendor}', [VendorController::class, 'update'])->name('vendors.update');

    // Delete vendor
    Route::delete('/vendors/{vendor}', [VendorController::class, 'destroy'])->name('vendors.destroy');

    //system users route
    Route::get('/system-users', [AuthController::class, 'showSystemUsers'])->name('system-users');
    Route::post('/employees/store', [AuthController::class, 'store'])->name('employees.store');

    Route::get('/systemusers', [SystemUsersController::class, 'showSystemUsers'])
        ->name('systemusers')
        ->middleware('checkAccess:SystemUsers');
    Route::get('/systemusers/add-employee', [SystemUsersController::class, 'registration'])
        ->name('systemusers.registration')
        ->middleware('checkAccess:SystemUsers');
    Route::get('/systemusers/profile/{employee}', [SystemUsersController::class, 'showProfile'])
        ->name('systemusers.profile')
        ->middleware('checkAccess:SystemUsers');
    Route::post('/systemusers/profile/{employee}/update', [SystemUsersController::class, 'updateEmployee'])
        ->name('systemusers.updateEmployee')
        ->middleware('checkAccess:SystemUsers');

    Route::get('/systemusers/edit-employee/{employee}', [SystemUsersController::class, 'editEmployeeInfo'])
        ->name('systemusers.editEmployeeInfo')
        ->middleware('checkAccess:SystemUsers');
    Route::post('/systemusers/{employee}/update', [SystemUsersController::class, 'updateEmployeeInfo'])
        ->name('systemusers.updateEmployeeInfo')
        ->middleware('checkAccess:SystemUsers'); 

    Route::post('/system-users/save-employee', [SystemUsersController::class, 'saveEmployee'])->name('save.employee');



    // Place this inside the web routes in web.php
    Route::post('/employees/create', [AuthController::class, 'storeEmployee'])->name('employees.create');

    //Employee profile page route
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::get('/profile/{employee}', [AuthController::class, 'showProfile'])->name('profile');

    // Report routes
    Route::get('/clientsummary', [ClientSummaryController::class, 'index'])->name('clientsummary.index');
    Route::get('/vendorsummary', [VendorSummaryController::class, 'index'])->name('vendorsummary.index');

    // (NOTES) Display the page to take notes with a list of clients ||||| Notes page
    Route::get('/takeNotes', [NoteController::class, 'create'])->name('notes.create');
    Route::get('/get-company-info/{id}', [NoteController::class, 'getCompanyInfo'])->name('getCompanyInfo');

    // Image handling
    Route::get('/notes/{note}/images', [ImageController::class, 'getImagesByNote'])->name('notes.images');
    Route::post('/notes/{note}/images', [ImageController::class, 'store'])->name('images.store');

    // notes page
    Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create');
    Route::post('/notes/store', [NoteController::class, 'store'])->name('notes.store');
    Route::get('/clients/{id}/notesAJAX', [NoteController::class, 'notesAJAX'])->name('clients.notesAJAX');

    // Route to show the form for editing a specific note
    Route::get('/notes/{note}/edit', [NoteController::class, 'edit'])->name('notes.edit');
    
    // last 5 orders
    Route::get('/clients/{id}/last-orders', [NoteController::class, 'lastOrders'])->name('clients.lastOrders');
    //Route::patch('/notes/{note}', [NoteController::class, 'update'])->name('notes.update');
    //Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
    // Display the page to create a new request based on the selected client
    // This assumes you have a separate RequestController for handling requests

// Display the specified order
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

// Show the form for editing the specified order
Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');

// Update the specified order in storage
Route::put('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');

// Remove the specified order from storage
Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');

// Route to view order profile
Route::get('/orderProfile/{id}', [OrderController::class, 'orderProfile'])->name('orderProfile');
Route::get('/orders/{order}/profile', [OrderController::class, 'profile'])->name('orders.profile');
// Routes for AJAX calls
Route::get('/api/orders/{id}', [OrderController::class, 'showAjax'])->name('orders.showAjax');
Route::get('/orders/all', [OrderController::class, 'getAllOrders'])->name('orders.all');
Route::get('/orders/details/{orderId}', [OrderController::class, 'getOrderDetails'])->name('orders.details');
Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
Route::put('/orders/{orderId}/update', [OrderController::class, 'update'])->name('orders.update');


    //SETTINGS
    Route::get('/settings', [SettingsController::class, 'index'])->name('site.settings');
    Route::post('/settings/save-mode', [SettingsController::class, 'saveMode'])->name('settings.save-mode');

// Route to fetch orders for a specific client
// Vendor routes
Route::get('/vendors', [VendorController::class, 'index'])->name('vendors.index');
Route::resource('vendors', VendorController::class);
// Place these inside the web.php file
//Route::get('/vendors', [VendorController::class, 'index'])->name('vendors.index');

// Update vendor

    //PAYMENTS
        // Show summary of payments
        Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');

        // Go to the form to add a new payment
        Route::get('/payment/add-payment', [PaymentController::class, 'create'])->name('payment.create');

        // Store a new payment record
        Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');

        // Show an individual payment profile
        Route::get('/payment/{id}', [PaymentController::class, 'show'])->name('payment.show');

Route::get('/vendors', [VendorController::class, 'index'])->name('vendors.index');
Route::resource('vendors', VendorController::class);

// The create vendor view will be served by the create method in VendorController
Route::get('vendors/create', [VendorController::class, 'create'])->name('vendors.create');


//system users route
Route::get('/system-users', [AuthController::class, 'showSystemUsers'])->name('system-users');
Route::post('/employees/store', [AuthController::class, 'store'])->name('employees.store');

Route::get('/systemusers', [SystemUsersController::class, 'showSystemUsers'])->name('systemusers');
Route::get('/systemusers/add-employee', [SystemUsersController::class, 'registration'])->name('systemusers.registration');
Route::get('/systemusers/profile/{employee}', [SystemUsersController::class, 'showProfile'])->name('systemusers.profile');
Route::post('/systemusers/profile/{employee}/update', [SystemUsersController::class, 'updateEmployee'])->name('systemusers.updateEmployee');

Route::post('/system-users/save-employee', [SystemUsersController::class, 'saveEmployee'])->name('save.employee');



// Place this inside the web routes in web.php
Route::post('/employees/create', [AuthController::class, 'storeEmployee'])->name('employees.create');

//Employee profile page route
Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
Route::get('/profile/{employee}', [AuthController::class, 'showProfile'])->name('profile');

// Report routes
Route::get('/clientsummary', [ClientSummaryController::class, 'index'])->name('clientsummary.index');
Route::get('/vendorsummary', [VendorSummaryController::class, 'index'])->name('vendorsummary.index');

// (NOTES) Display the page to take notes with a list of clients ||||| Notes page
Route::get('/takeNotes', [NoteController::class, 'create'])->name('notes.create');
Route::get('/get-company-info/{id}', [NoteController::class, 'getCompanyInfo'])->name('getCompanyInfo');
Route::post('/notes/{noteId}/images', [ImageController::class, 'store'])->name('images.store');
// Displays last five Orders route
Route::get('/clients/{id}/orders', [NoteController::class, 'getClientOrders'])->name('clients.orders');
//notes page
Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create');
Route::post('/notes/store', [NoteController::class, 'store'])->name('notes.store');
Route::get('/clients/{id}/notesAJAX', [ClientController::class, 'notesAJAX'])->name('clients.notesAJAX');
// Route to show the form for editing a specific note
Route::get('/notes/{note}/edit', [NoteController::class, 'edit'])->name('notes.edit');
// Route to update a specific note
//Route::patch('/notes/{note}', [NoteController::class, 'update'])->name('notes.update');
//Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
// Display the page to create a new request based on the selected client
// This assumes you have a separate RequestController for handling requests

//request page
// Define a route for the createRequest view



//PERMISSIONS
Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions');

//SETTINGS
Route::get('/settings', [SettingsController::class, 'index'])->name('site.settings');
Route::post('/settings/save-mode', [SettingsController::class, 'saveMode'])->name('settings.save-mode');

//FAQ
Route::get('/faq', [FAQController::class, 'showFAQ'])->name('faq.show');

//PAYMENTS
    // Show summary of payments
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');

    // Go to the form to add a new payment
    Route::get('/payment/add-payment', [PaymentController::class, 'create'])->name('payment.create');

    // Store a new payment record
    Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');

    // Show an individual payment profile
    Route::get('/payment/{id}', [PaymentController::class, 'show'])->name('payment.show');

    // Get the products associated with an order
    Route::get('/get-products-for-order/{orderId}', [PaymentController::class, 'getProductsForOrder']);

    // Delete a payment record
    Route::delete('/payment/{id}', [PaymentController::class, 'deletePayment'])->name('payment.deletePayment');

    // Edit a payment record
    Route::get('/payment/profile/{id}', [PaymentController::class, 'editPayment'])->name('payment.editPayment');

    // Update a payment record
    Route::post('/payment/{id}/update', [PaymentController::class, 'updatePayment'])->name('payment.updatePayment'); 


//AGREEMENTS
Route::get('/Agreement', [AgreementController::class, 'show']) -> name('agreement.show');
// Display the form
Route::get('/agreement', [AgreementController::class, 'create'])->name('agreement.create');
// Handle form submission
Route::post('/agreement', [AgreementController::class, 'store'])->name('agreement.store');


//reports
Route::get('/client-sales-summary', [ClientSalesReportController::class, 'index'])->name('clientSalesSummary.index');
Route::get('/reports/order-volume', [OrderVolumeReportController::class, 'index'])->name('orderVolumeReport.index');
Route::get('/reports/orders-by-status', [OrderStatusReportController::class, 'index'])->name('ordersByStatus.index');


Route::get('/reports/sales-by-employee', [SalesByEmployeeReportController::class, 'index'])->name('salesByEmployeeReport.index');
Route::get('/reports', [ReportController::class, 'indexReports'])->name('reports.index');
Route::get('/personal-sales-report', [SalesByEmployeePersonalController::class, 'index'])
     ->name('personal-sales-report');
   