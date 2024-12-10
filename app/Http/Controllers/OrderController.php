<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $orders = Order::with(['user', 'deliveryPerson', 'orderItems', 'deliveryDetails'])->get();
        return response()->json($orders, 200);
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_amount' => 'required|numeric|min:0',
            'order_date' => 'required|date_format:Y-m-d',
            'status' => 'required|string|in:pending,confirmed,completed,canceled',
            'address' => 'required|string|max:255',
            'delivery_person_id' => 'nullable|exists:users,id',
        ]);

        $order = Order::create($validated);

        return response()->json($order->load(['user', 'deliveryPerson', 'orderItems', 'deliveryDetails']), 201);
    }

    // Display the specified resource
    public function show($id)
    {
        $order = Order::with(['user', 'deliveryPerson', 'orderItems', 'deliveryDetails'])->find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json($order, 200);
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'total_amount' => 'sometimes|numeric|min:0',
            'order_date' => 'sometimes|date_format:Y-m-d',
            'status' => 'sometimes|string|in:pending,confirmed,completed,canceled',
            'address' => 'sometimes|string|max:255',
            'delivery_person_id' => 'nullable|exists:users,id',
        ]);

        $order->update($validated);

        return response()->json($order->load(['user', 'deliveryPerson', 'orderItems', 'deliveryDetails']), 200);
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $order->delete();

        return response()->json(['message' => 'Order deleted'], 204);
    }
}
