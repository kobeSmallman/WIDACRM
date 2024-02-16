<?php 

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

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
        // When storing a new order, directly use request data
        $orderData = $request->all(); // This gets all input data
    
        // Check if Order_ID is sent from the form, if not generate a unique one
        if (empty($orderData['Order_ID'])) {
            $orderData['Order_ID'] = 'ORD-' . time() . '-' . Str::random(5);
        }
    
        // Ensure Order_Status and Request_Status have a value
        $orderData['Order_Status'] = $orderData['Order_Status'] ?? 'Active';
        $orderData['Request_Status'] = $orderData['Request_Status'] ?? 'Active';
    
        // Create and save the order
        $order = new Order($orderData);
        $order->save();
    
        // Redirect to the orders page with a success message
        return redirect()->route('orders.index')->with('success', 'New order has been created.');
    }

    public static function list(): View {
        $orders = DB::select('select * from u126104410_Hexacrm.Order');
                                            // variable i will call on blade
        return view('notes.orderDetails', ['orders' => $orders]);
    }
    

    // Add other necessary methods as needed
}
