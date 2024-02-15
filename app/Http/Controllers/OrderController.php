<?php 

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Client; // Make sure to include the Client model
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all(); // Fetch all orders from the database
        $clients = Client::all(); // Fetch all clients from the database to be used in the order form dropdown
        
        // Pass both $orders and $clients to the view
        return view('Order.order', compact('orders', 'clients'));
    }

    public function store(Request $request)
    {
        // When storing a new order, directly use request data
        $orderData = $request->all(); // This gets all input data
    
        // Check if Order_ID is sent from the form, if not generate a unique one
        if (empty($orderData['Order_ID'])) {
            $orderData['Order_ID'] = 'ORD-' . time() . '-' . Str::random(5);
        }
    
        // Ensure Order_Status and Request_Status have a value
        $orderData['Order_Status'] = $orderData['Order_Status'] ?? 'Active';
        $orderData['Request_Status'] = $orderData['Request_Status'] ?? 'Active';
    
        // Handle product requests if they are included
        if (isset($orderData['product_requests'])) {
            foreach ($orderData['product_requests'] as $productRequest) {
                // Here you would handle each product request.
                // For simplicity, we are just logging the data.
                // You would typically save this to the database.
                \Log::info('Product Request:', $productRequest);
            }
            unset($orderData['product_requests']); // Remove product requests from order data to prevent issues on saving the order
        }
    
        // Create and save the order
        $order = new Order($orderData);
        $order->save();
    
        // Redirect to the orders page with a success message
        return redirect()->route('orders.index')->with('success', 'New order has been created.');
    }
    

    // Add other necessary methods as needed
}
