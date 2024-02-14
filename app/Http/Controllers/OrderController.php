<?php 

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all(); // Fetch all orders from the database
        // Make sure the view path matches the file location within the resources/views directory
        return view('Order.order', compact('orders'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            // Specify your validation rules
            'client_id' => 'required|exists:clients,id',
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string'
        ]);

        // Create a new order using the validated data
        $order = Order::create($validatedData);
        // When storing a new order
$order = new Order($request->all());
$order->Order_ID = 'ORD-' . time() . '-' . Str::random(5); // 'ORD-' prefix with a unique identifier
$order->save();

        // Redirect to the orders page with a success message
        return redirect()->route('orders.index')->with('success', 'New order has been created.');
    }

    // Add other necessary methods as needed
}
