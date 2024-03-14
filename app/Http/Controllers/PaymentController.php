<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PaymentType;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\Product;

class PaymentController extends Controller
{
    // Show the summary of payments
    public function index() {
        $payments = Payment::all(); // Retrieve all payments
        $payments = Payment::with('paymentType')->get(); // Eager load the payment type relationship
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
        // Add validation for the request data
        $request->validate([
            'Order_ID' => 'required|exists:Order,Order_ID', // make sure the Order_ID exists in the Order table
            'Date' => 'required|date',
            'PMT_Cat' => 'required|string|max:255',
            'Amount' => 'required|numeric',
            'PMT_Type_ID' => 'required|exists:Payment_Type,PMT_Type_ID', // ensure PMT_Type_ID exists in Payment_Type table
        ]);

        // Check if there is an existing Product Payment
        if ($request->PMT_Cat !== 'Freight') {
        $existingPayment = Payment::where('Order_ID', $request->Order_ID)
                                ->where('PMT_Cat', 'Product') 
                                ->first();

        if ($existingPayment) {
            // Redirect back with error message if payment exists
            return redirect()->back()->withErrors([
                'msg' => 'There is already an associated Product Payment for this order: <a href="'.route('payment.show', ['id' => $existingPayment->PMT_ID]).'">PMT_ID '.$existingPayment->PMT_ID.'</a>'
            ]);
        }
    }

        // Assuming Payment is the your Eloquent model for the payment table
        $payment = new Payment();
        $payment->Order_ID = $request->Order_ID;
        $payment->Date = $request->Date;
        $payment->PMT_Cat = $request->PMT_Cat;
        $payment->Amount = $request->Amount;
        // Assign the payment type ID from the request directly
        $payment->PMT_Type_ID = $request->PMT_Type_ID;

        $payment->save();

        // After storing, redirect to the summary of payments with a success message
        return redirect()->route('payment.index')->with('success', 'Payment added successfully.');
    }
    // Show the profile of a payment
        public function show($PMT_ID) {
        $payment = Payment::findOrFail($PMT_ID); // Find the payment by id
        return view('payment.profile', compact('payment'));
    }

    //Get products of each order
    public function getProductsForOrder($Order_ID) {
        $products = Product::where('Order_ID', $Order_ID)->get();
    
        return response()->json($products);
    }

    public function deletePayment($id)
    { 
        $payment = Payment::findOrFail($id); 
        $payment->delete();
 
        return redirect()->route('payment.index')->with('success', 'Payment deleted successfully.');
    }

    public function editPayment($id)
    { 
        // Retrieve the order ID from the payment
        $payment = Payment::findOrFail($id);
        $selectedOrder = Order::findOrFail($payment->Order_ID);
        $orderDetails = $selectedOrder->products()->get();
        $selectedPayment = Payment::where('PMT_ID', $id)->first();
    
        return view('payment.profile', compact('selectedOrder', 'orderDetails', 'payment'));
    }

    public function update(Request $request, $id)
    { 
        $payment = Payment::findOrFail($id);
         
        $payment->update($request->all());
 
        return redirect()->route('clients.editPayment', compact('payment')); 
    }
    
    
}