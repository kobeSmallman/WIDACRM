<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PaymentType;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Show the summary of payments
    public function index() {
        $payments = Payment::all(); // Retrieve all payments
        return view('payment.index', compact('payments'));
    }

    // Show the form to add a new payment
    public function create()
    {
        // Fetch all order IDs to populate the dropdowns
        $orders = Order::pluck('Order_ID', 'Order_ID');

        // Fetch only active payment types to populate the dropdowns
        $paymentTypes = PaymentType::where('Active_Status', 'Active')
                                    ->pluck('PMT_Type_Name', 'PMT_Type_ID');

        // Return the add payment view with the data
        return view('payment.addPayment', compact('orders', 'paymentTypes'));
    }

    // Store a new payment record
    public function store(Request $request)
    {
        // To do: Add validation and storing logic here

        // Assuming Payment is your Eloquent model for the payment table
        $payment = new Payment();
        $payment->Order_ID = $request->Order_ID;
        $payment->Date = $request->Date;
        $payment->PMT_Cat = $request->PMT_Cat;
        $payment->Amount = $request->Amount;
        // The payment type is identified by PMT_Type_ID, not PMT_Type_Name
        $payment->PMT_Type_ID = $request->PMT_Type_ID;

        $payment->save();

        // After storing, redirect to the summary of payments
        return redirect()->route('payment.index')->with('success', 'Payment added successfully.');
    }
    // Show the profile of a payment
        public function show($PMT_ID) {
        $payment = Payment::findOrFail($PMT_ID); // Find the payment by id
        return view('payment.profile', compact('payment'));
    }
}
