<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate the incoming request data
            $validatedData = $request->validate([
                'address' => 'required|string',
                'postalCode' => 'required',
                'payment' => 'required|string',
                'country' => 'required|string',
                'userId' => 'required|exists:users,id',
                'orderItems' => 'required|array',
                'orderItems.*.productId' => 'required|exists:products,id',
                'orderItems.*.quantity' => 'required|integer|min:1',
            ]);

            // Create a new order
            $order = new Order();
            $order->address = $validatedData['address'];
            $order->postalCode = $validatedData['postalCode'];
            $order->payment = $validatedData['payment'];
            $order->country = $validatedData['country'];
            $order->userId = $validatedData['userId'];
            $order->save();

            // Create and associate order items
            foreach ($validatedData['orderItems'] as $itemData) {
                $productId = $itemData['productId'];
                $requestedQuantity = $itemData['quantity'];

                // Retrieve the product
                $product = Product::findOrFail($productId);

                // Check if the product quantity is sufficient
                if ($product->stock < $requestedQuantity) {
                    // Product quantity is insufficient, rollback transaction and throw an exception
                    DB::rollBack();
                    throw ValidationException::withMessages([
                        'orderItems' => ["Insufficient quantity for product with ID: $productId"],
                    ]);
                }

                // Product quantity is sufficient, create the order item
                $orderItem = new OrderItem();
                $orderItem->productId = $productId;
                $orderItem->orderId = $order->id;
                $orderItem->quantity = $requestedQuantity;
                $orderItem->save();

                // Update product quantity
                $product->stock -= $requestedQuantity;
                $product->save();
            }

            DB::commit();

            // Transform the order into JSON using the OrderResource
            $orderResource = new OrderResource($order);

            // Return the JSON response
            return $orderResource->response()->setStatusCode(201);
        } catch (\Exception $e) {
            // Something went wrong, rollback transaction and handle the exception
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            // Validate the user ID
            if (!is_numeric($id) || $id <= 0) {
                throw new \InvalidArgumentException('Invalid user ID provided.');
            }

            // Retrieve orders associated with the user ID and include related data
            $orders = Order::where('userId', $id)
                ->with('items.product')
                ->get();

            // Check if any orders were found
            if ($orders->isEmpty()) {
                throw new ModelNotFoundException('No orders found for the specified user ID.');
            }

            // Return the orders as a collection of OrderResource
            return OrderResource::collection($orders);
        } catch (\InvalidArgumentException | ModelNotFoundException $e) {
            // Handle invalid user ID or no orders found exception
            return response()->json(['error' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            // Handle other unexpected exceptions
            return response()->json(['error' => 'Something went wrong.'], 500);
        }
    }
}
