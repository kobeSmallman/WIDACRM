<?php 

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Client;
use App\Models\Vendor;
use App\Models\Employee;
use App\Models\Payment;
use App\Models\PaymentType;
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
        $clients = Client::all(); // Retrieve all clients
        $vendors = Vendor::all();
       return view('Order.createOrder', compact('clients', 'vendors')); 
    }
    

public function store(Request $request)
{
    Log::info('Request Data:', $request->all());

      // Temporarily commenting out validation for debugging purposes
     $validatedData = $request->validate([
         'Client_ID' => 'required|exists:Client,Client_ID',
         'Created_By' => 'required|integer',
         'Request_DATE' => 'required|date',
         'Request_Status' => 'required|string|max:255',
         'Remarks' => 'nullable|string',
         'Order_DATE' => 'required|date',
         'Order_Status' => 'required|string|max:255',
         'Quotation_DATE' => 'nullable|date',
         'products.*.Product_Name' => 'required|string|max:255',
         'products.*.Quantity' => 'required|integer|min:1',
         'products.*.Vendor_ID' => 'required|exists:Vendor,Vendor_ID', // Adjust Vendor,Vendor_ID based on your Vendor table and primary key
         'products.*.Shipping_Status' => 'required|string|max:255',
         'products.*.Shipped_Qty' => 'required|integer|min:0',
         'products.*.Product_Price' => 'required|numeric|min:0',
         'products.*.Product_Status' => 'required|string|max:255',
         'products.*.QA_Status' => 'required|string|max:255',
         'products.*.Storage_Status' => 'required|string|max:255',
         'products.*.Prod_Status' => 'required|string|max:255',
     ]);

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
                'Order_ID' => $order->Order_ID, // the ID of the Order to which this Product is related
                'Product_Name' => $productData['Product_Name'], // name of the product
                'Quantity' => $productData['Quantity'], // quantity of the product
                'Vendor_ID' => $productData['Vendor_ID'], // the ID of the Vendor
                'Shipping_Status' => $productData['Shipping_Status'], // shipping status of the product
                'Shipped_Qty' => $productData['Shipped_Qty'], // quantity of the product that was shipped
                'Product_Price' => $productData['Product_Price'], // price of the product
                'Product_Status' => $productData['Product_Status'], // status of the product
                'QA_Status' => $productData['QA_Status'], // QA status of the product
                'Storage_Status' => $productData['Storage_Status'], // storage status of the product
                'Prod_Status' => $productData['Prod_Status'], // production status of the product
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
        DB::rollback();
        Log::error($e->getMessage());
        return back()->withErrors('Failed to create order.')->withInput();
    }
}
public function editPayment($orderId)
{
    $order = Order::with(['payments', 'products'])->findOrFail($orderId);
    $payment = $order->payments->first();

    if (!$payment) {
        return redirect()->route('orders.addPayment', ['order' => $orderId]);
    }

    $selectedOrder = $order; // Assuming the 'payment.profile' view needs this variable
    $orderDetails = $order->products;
    $paymentTypes = PaymentType::where('Active_Status', 'Active')
                                ->pluck('PMT_Type_Name', 'PMT_Type_ID');
    $orders = Order::pluck('Order_ID', 'Order_ID');

    return view('payment.profile', compact('selectedOrder', 'orderDetails', 'payment', 'orders', 'paymentTypes'));
}


public function addPayment($orderId)
{
    $selectedOrder = Order::findOrFail($orderId);
    $orders = Order::pluck('Order_ID', 'Order_ID');
    $paymentTypes = PaymentType::where('Active_Status', 'Active')->pluck('PMT_Type_Name', 'PMT_Type_ID');

    // Pass the selected order to the view
    return view('payment.addPayment', compact('selectedOrder', 'orders', 'paymentTypes'));
}



public function show($id)
{
    // Eager load the 'payments' relationship with the order
    $order = Order::with(['client', 'products', 'payments'])->findOrFail($id);
    return view('Order.orderProfile', compact('order'));
}

    public function edit($orderId)
    {
        $order = Order::with(['client', 'products'])->findOrFail($orderId);
        $employeeId = $order->Created_By;
        $employee = Employee::find($employeeId); // Fetch the employee directly
    
        $products = $order->products;
        $client = $order->client;
    
        // Fetch all clients and vendors for the dropdown options
        $clients = Client::all();
        $vendors = Vendor::all();
    
        // Now pass all the necessary data to the view
        return view('Order.editOrder', compact('order', 'employee', 'products', 'client', 'clients', 'vendors'));
    }


    public function updateOrder(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            // Assuming validation rules are provided correctly
            // Validate order fields
            'Client_ID' => 'required|exists:Client,Client_ID',
            'Request_DATE' => 'required|date',
            'Request_Status' => 'required|string',
            'Remarks' => 'nullable|string',
            'Order_DATE' => 'required|date',
            'Order_Status' => 'required|string',
            'Quotation_DATE' => 'nullable|date',
            // Validate product fields, adjust according to your actual form structure
            'products.*.Product_Name' => 'required|string|max:255',
            'products.*.Quantity' => 'required|numeric|min:1',
            'products.*.Product_Price' => 'required|numeric',
            // Add validation rules for other product fields as necessary
        ]);
    
        // Start transaction
        DB::beginTransaction();
        try {
            $order = Order::findOrFail($order);
            // Update order fields
            $order->Client_ID = $validatedData['Client_ID'];
            $order->Request_DATE = $validatedData['Request_DATE'];
            $order->Request_Status = $validatedData['Request_Status'];
            $order->Remarks = $validatedData['Remarks'];
            $order->Order_DATE = $validatedData['Order_DATE'];
            $order->Order_Status = $validatedData['Order_Status'];
            $order->Quotation_DATE = $validatedData['Quotation_DATE'];
            $order->save();
    
            // Update products
            // First, remove all existing products to handle deletions
            $order->products()->delete();
            // Then, add updated/new products
            foreach ($validatedData['products'] as $productData) {
                $order->products()->create($productData);
            }
    
            // Commit transaction
            DB::commit();
    
            return redirect()->route('orders.show', $order->Order_ID)->with('success', 'Order updated successfully.');
        
        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollback();
    
            // Log error or handle it as necessary
            return redirect()->route('orders.edit', $order)->withErrors('Failed to update order.');
        }
    }
    

    public function update(Request $request, $orderId)
{
    $validatedData = $request->validate([
        // Validate order fields
        'Client_ID' => 'required|exists:Client,Client_ID', // Assuming 'Client_ID' is the primary key column in 'Client' table
        'Request_DATE' => 'required|date',
        'Request_Status' => 'required|string',
        'Remarks' => 'nullable|string',
        'Order_DATE' => 'required|date',
        'Order_Status' => 'required|string',
        'Quotation_DATE' => 'nullable|date',
        // Validate product fields, adjust according to your actual form structure
        'products.*.Product_Name' => 'required|string|max:255',
        'products.*.Quantity' => 'required|numeric|min:1',
        'products.*.Product_Price' => 'required|numeric',
        // Add validation rules for other product fields as necessary
    ]);

    // Start transaction
    DB::beginTransaction();
    try {
        $order = Order::findOrFail($orderId);
        // Update order fields
        $order->Client_ID = $validatedData['Client_ID'];
        $order->Request_DATE = $validatedData['Request_DATE'];
        $order->Request_Status = $validatedData['Request_Status'];
        $order->Remarks = $validatedData['Remarks'];
        $order->Order_DATE = $validatedData['Order_DATE'];
        $order->Order_Status = $validatedData['Order_Status'];
        $order->Quotation_DATE = $validatedData['Quotation_DATE'];
        $order->save();

        // Update products
        // First, remove all existing products to handle deletions
        $order->products()->delete();
        // Then, add updated/new products
        foreach ($validatedData['products'] as $productData) {
            // Be sure to validate the existence of Vendor_ID against the 'Vendor' table if required
            $order->products()->create($productData);
        }

        // Commit transaction
        DB::commit();

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');

    } catch (\Exception $e) {
        // Rollback transaction on error
        DB::rollback();

        // Log error or handle it as necessary
        return redirect()->route('orders.edit', $orderId)->withErrors('Failed to update order.');
    }
}


    public function destroy($id)
    {
        try {
            $order = Order::findOrFail($id);
    
            // Begin transaction
            DB::beginTransaction();
    
            // Delete related products first to maintain referential integrity
            $order->products()->delete();
    
            // Now delete the order
            $order->delete();
    
            // Commit the transaction
            DB::commit();
    
            return response()->json(['success' => 'Order and related products deleted successfully.']);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return response()->json(['error' => 'Failed to delete order.'], 500);
        }
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
