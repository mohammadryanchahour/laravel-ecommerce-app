<?php

namespace App\Http\Controllers;

use App\Models\Order;

use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        try {
            // Fetch all orders along with their associated products
            $orders = Order::with('products')->get();

            return response()->json(['orders' => $orders], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch orders: ' . $e->getMessage()], 500);
        }
    }


    public function show($id)
    {
        try{
            $order = Order::findOrFail($id);
            return response()->json(['order' => $order], 200);
        } catch(\Exception $e)
        {
            return response()->json(['error' => 'Failed to fetch order: '. $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'products' => 'required|array',
                'products.*.id' => 'required|exists:products,id',
                'products.*.quantity' => 'required|integer|min:1',
                'billing_address' => 'nullable|string',
                'shipping_address' => 'required|string',
                'payment_method' => 'required|in:card,stripe,cash', 
                'notes' => 'nullable|string',
            ]);

            $user = $request->user();

            // Create the Order instance
            $order = $user->orders()->create([
                'status' => $request->input('status'),
                'total_amount' => $request->input('total_amount'),
                'billing_address' => $request->input('billing_address'),
                'shipping_address' => $request->input('shipping_address'),
                'payment_method' => $request->input('payment_method'),
                'notes' => $request->input('notes'),
            ]);

            foreach ($request->input('products') as $product) {
                $order->products()->attach($product['id'], ['quantity' => $product['quantity']]);
            }

            return response()->json(['order' => $order, 'message' => 'Order Placed Successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to place order: ' . $e->getMessage()], 500);
        }
    }

        public function update(Request $request, $id)
    {
        try {
            $order = Order::findOrFail($id);

            $request->validate([
                // Validation rules for update
                // Example: 'shipping_address' => 'nullable|string',
                // You can add more rules based on what you want to allow updating
            ]);

            $order->update($request->all());

            return response()->json(['message' => 'Order updated successfully', 'order' => $order], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update order: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->delete();

            return response()->json(['message' => 'Order Removed successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to remove order: ' . $e->getMessage()], 500);
        }
    }


    public function userOrders(Request $request)
    {
        try {
            $user = $request->user(); // Assuming you have authentication and can retrieve the user
            $orders = $user->orders()->with('products')->get();
            return response()->json(['orders' => $orders], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch user orders: ' . $e->getMessage()], 500);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $order = Order::findOrFail($id);

            $request->validate([
                'status' => 'required|string|in:pending,processing,shipped,delivered,canceled', // Define your order statuses
            ]);

            $order->status = $request->input('status');
            $order->save();

            return response()->json(['message' => 'Order status updated successfully', 'order' => $order], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update order status: ' . $e->getMessage()], 500);
        }
    }

    public function attachProduct(Request $request, $orderId)
    {
        try {
            $order = Order::findOrFail($orderId);

            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1',
            ]);

            $order->products()->attach($request->input('product_id'), ['quantity' => $request->input('quantity')]);

            return response()->json(['message' => 'Product attached to order successfully', 'order' => $order], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to attach product to order: ' . $e->getMessage()], 500);
        }
    }

    public function detachProduct(Request $request, $orderId)
    {
        try {
            $order = Order::findOrFail($orderId);

            $request->validate([
                'product_id' => 'required|exists:products,id',
            ]);

            $order->products()->detach($request->input('product_id'));

            return response()->json(['message' => 'Product detached from order successfully', 'order' => $order], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to detach product from order: ' . $e->getMessage()], 500);
        }
    }

    
}
