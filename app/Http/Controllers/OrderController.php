<?php 

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB; 
use App\Models\Product;
class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        $clients = Client::all();
        return view('Order.order', compact('orders', 'clients'));
    }

    public function create()
    {
        return view('Order.createOrder');
    }

 
public function store(Request $request)
{
    Log::info('Request Data:', $request->all());

      // Temporarily commenting out validation for debugging purposes
    // $validatedData = $request->validate([
    //     'Client_ID' => 'required|exists:clients,Client_ID',
    //     'Created_By' => 'required|integer',
    //     'Request_DATE' => 'required|date',
    //     'Request_Status' => 'required|string|max:255',
    //     'Remarks' => 'nullable|string',
    //     'Order_DATE' => 'required|date',
    //     'Order_Status' => 'required|string|max:255',
    //     'Quotation_DATE' => 'nullable|date',
    // ]);

    // Begin a transaction to ensure data integrity
    $orderData = $request->all();
        // Create a new Order model instance
        DB::beginTransaction();
    try {
        // Find the last order and increment its ID by one
        $latestOrder = Order::orderBy('Order_ID', 'desc')->first();
        $latestNumber = $latestOrder ? intval(substr($latestOrder->Order_ID, 1)) + 1 : 1;
        $newOrderId = 'O' . str_pad($latestNumber, 3, '0', STR_PAD_LEFT);

        // Create a new Order model instance
        $order = new Order;
        $order->Order_ID = $newOrderId; // Use the new Order_ID here
        $order->Client_ID = $orderData['Client_ID'];
        $order->Created_By = $orderData['Created_By'];
        $order->Request_DATE = $orderData['Request_DATE'];
        $order->Request_Status = $orderData['Request_Status'];
        $order->Remarks = $orderData['Remarks'] ?? null;
        $order->Order_DATE = $orderData['Order_DATE'];
        $order->Order_Status = $orderData['Order_Status'];
        $order->Quotation_DATE = $orderData['Quotation_DATE'] ?? null;

        // Log the order attributes before save
        Log::info('Order Attributes:', $order->getAttributes());

        // Save the Order
        $order->save();

        // If the request includes product details
        $productRequests = $request->input('products', []);
        foreach ($productRequests as $productData) {
            // Add this log to see what data is received
            Log::info('Product Data:', $productData);
        
            // Validate each product's data before creating the product records
            // Add your validation logic here if needed
            
            $product = new Product([
                'Order_ID' => $order->Order_ID,
                'Product_Name' => $productData['Product_Name'],
                'Quantity' => $productData['Quantity'],
                'Vendor_ID' => $productData['Vendor_ID'],
                'Product_Price' => $productData['Product_Price'],
                // ... any other product fields
            ]);
        
            // Add this log to see the attributes just before saving
            Log::info('Product Attributes before save:', $product->getAttributes());
        
            // Save the product
            $product->save();
        }
        


        // Commit the transaction
        DB::commit();

        // Redirect back with a success message
        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    } catch (\Exception $e) {
        // Rollback the transaction in case of error
        DB::rollback();

        // Log the error message
        Log::error($e->getMessage());

        // Redirect back with an error message
        return back()->withErrors('Failed to create order.')->withInput();
    }
}

    public function show($id)
    {
        $order = Order::with(['client', 'products'])->findOrFail($id);
        return view('orderProfile', compact('order'));
    }

    public function edit($id)
{
    $order = Order::findOrFail($id);
    $clients = Client::all();
    return view('orders.edit', compact('order', 'clients'));
}


    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $orderData = $request->except(['_token', '_method', 'product_requests']);
        $order->update($orderData);
        if ($request->has('product_requests')) {
            foreach ($request->input('product_requests') as $productRequest) {
                Log::info('Updating product for order: ', $productRequest);
            }
        }
        return redirect()->route('orders.edit', ['id' => $id])->with('success', 'Order updated successfully.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
    public function profile($orderId)
{
    $order = Order::with(['client', 'products'])->where('Order_ID', $orderId)->firstOrFail();
    // Ensure $order is correctly retrieved
    if (!$order) {
        // Handle the error, e.g., return a different view or redirect with an error message
    }
    return view('Order.orderProfile', compact('order'));
}

    
    

    public function showAjax($id)
    {
        $order = Order::with(['client', 'products'])->findOrFail($id);
        return response()->json($order);
    }

    public function getAllOrders()
    {
        $orders = Order::with(['products', 'client'])->get();
        $formattedOrders = $orders->map(function ($order) {
            return [
                'Order_ID' => $order->Order_ID,
                'Client_ID' => optional($order->client)->ID,
                'Client_Name' => optional($order->client)->Name,
                'Company_Name' => optional($order->client)->Company_Name,
            ];
        });
        return response()->json([
            'data' => $formattedOrders,
            'recordsTotal' => count($formattedOrders),
            'recordsFiltered' => count($formattedOrders),
        ]);
    }

    public static function list() {
        $orders = DB::select('select * from u126104410_Hexacrm.Order');
        return view('notes.orderDetails', ['orders' => $orders]);
    }

    // Other methods as needed
}
