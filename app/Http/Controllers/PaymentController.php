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
        // First, remove commas from the 'Amount' field to prevent validation error
        $amountInput = str_replace(',', '', $request->input('Amount'));
        // Manually validate the 'Amount' after removing commas
        if (!is_numeric($amountInput)) {
            return redirect()->back()->withErrors(['Amount' => 'The amount field must be a number.']);
        }

        // Validate the rest of the request data without 'Amount'
        $validatedData = $request->validate([
            'Order_ID' => 'required|exists:Order,Order_ID',
            'Date' => 'required|date',
            'PMT_Cat' => 'required|string|max:255',
            'PMT_Type_ID' => 'required|exists:Payment_Type,PMT_Type_ID',
        ]);

        // Proceed with the sanitized amount
        $sanitizedAmount = floatval($amountInput);

        // Check if there is an existing Product Payment
        if ($request->PMT_Cat !== 'Freight') {
        $existingPayment = Payment::where('Order_ID', $request->Order_ID)
                                ->where('PMT_Cat', 'Product') 
                                ->first();

        if ($existingPayment) {
            // Redirect back with error message if payment exists
            return redirect()->back()->withErrors([
                'msg' => 'There is already an associated Product Payment for this order: <a href="'.route('payment.editPayment', ['id' => $existingPayment->PMT_ID]).'">PMT_ID '.$existingPayment->PMT_ID.'</a>'
            ]);
        }
    }

        // Create and save the new payment
        $payment = new Payment();
        $payment->Order_ID = $request->Order_ID;
        $payment->Invoice_Number = $request->Invoice_Number;
        $payment->Date = $request->Date;
        $payment->PMT_Cat = $request->PMT_Cat;
        $payment->Amount = $sanitizedAmount; // this uses the sanitized amount
        $payment->Remarks = $request->Remarks;
        // Assign the payment type ID from the request directly
        $payment->PMT_Type_ID = $request->PMT_Type_ID;

        $payment->save();

        // After storing, redirect to the summary of payments with a success message
        return redirect()->route('payment.index')->with('success', 'Payment added successfully.');
    }
    /*
    This function is repleced by editPayment
    // Show the profile of a payment
        public function show($PMT_ID) {
        $payment = Payment::findOrFail($PMT_ID); // Find the payment by id
        return view('payment.profile', compact('payment'));
    }
    */

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
        $orders = Order::pluck('Order_ID', 'Order_ID'); // Get all orders for the dropdown
        // Fetch only active payment types to populate the dropdowns
        $paymentTypes = PaymentType::where('Active_Status', 'Active')
                                    ->pluck('PMT_Type_Name', 'PMT_Type_ID');
    
        return view('payment.profile', compact('selectedOrder', 'orderDetails', 'payment', 'orders', 'paymentTypes'));
    }
/* THIS DOES NOT PUSH CHANGES TO THE DATABASE
    public function updatePayment(Request $request, $id)
    { 
        $payment = Payment::findOrFail($id);
        
        $validatedData = $request->validate([
            'Date' => 'required|date',
            'PMT_Cat' => 'required|string|max:255',
            'Amount' => 'required|numeric',
            'PMT_Type_ID' => 'required|exists:Payment_Type,PMT_Type_ID',
        ]);
    
        $validatedData['Amount'] = floatval(str_replace(',', '', $request->Amount)); // Sanitize the Amount
    
        $payment->update($validatedData);
    
        return redirect()->route('payment.editPayment', ['id' => $id])->with('success', 'Payment updated successfully.');
    }
    
    */

    /* THIS WORKS
    public function updatePayment(Request $request, $id)
    { 
        $payment = Payment::findOrFail($id);
         
        $payment->update($request->all());
 
        return redirect()->route('payment.editPayment', ['id' => $id])->with('success', 'Payment updated successfully.'); 
    }
    */

    public function updatePayment(Request $request, $id)
{ 
    $payment = Payment::findOrFail($id);
    
    // Get all the request data.
    $requestData = $request->all();
    
    // Check if the Amount is set and sanitize it.
    if(isset($requestData['Amount'])) {
        // Remove any commas and convert to float.
        $requestData['Amount'] = floatval(str_replace(',', '', $requestData['Amount']));
    }
    
    // Update the payment with sanitized data.
    $payment->update($requestData);

    return redirect()->route('payment.editPayment', ['id' => $id])->with('success', 'Payment updated successfully.'); 
}

    
}