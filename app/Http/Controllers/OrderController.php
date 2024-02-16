<?php 

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Client; // Make sure to include the Client model
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
class OrderController extends Controller
{
    public function show($id)
    {
        $order = Order::with(['client', 'products'])->findOrFail($id);
        return response()->json($order);
    }

    public function edit($id)
    {
        $order = Order::with(['client', 'products'])->findOrFail($id);
        $clients = Client::all(); // In case you need to change the client
        // Assuming you have a view named 'orders.edit' with a form for editing orders
        return view('orders.edit', compact('order', 'clients'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $orderData = $request->except(['_token', '_method', 'product_requests']);
        
        $order->update($orderData);

        // Handle product updates here...
        // This might involve syncing products, updating quantities, etc.
        // This is a simplified example. You'll need to adjust it based on your actual requirements.
        if ($request->has('product_requests')) {
            foreach ($request->input('product_requests') as $productRequest) {
                // Process each product request. This could mean updating existing products, adding new ones, etc.
                Log::info('Updating product for order: ', $productRequest);
            }
        }

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
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
    
    public function getAllOrders()
{
    $orders = Order::with(['products', 'client'])->get();

    $formattedOrders = $orders->map(function ($order) {
        // Format each order with the necessary fields
        // Adjust the fields based on your actual database columns
        return [
            'Order_ID' => $order->Order_ID,
            'Client_ID' => optional($order->client)->ID,
            'Client_Name' => optional($order->client)->Name,
            'Company_Name' => optional($order->client)->Company_Name,
            // ... include all other necessary fields
            // If you have multiple products per order, you'll need to handle this differently
        ];
    });

    // Return a response expected by DataTables
    return response()->json([
        'data' => $formattedOrders,
        'recordsTotal' => count($formattedOrders),
        'recordsFiltered' => count($formattedOrders),
    ]);
}

    
    
    // Add other necessary methods as needed
}
