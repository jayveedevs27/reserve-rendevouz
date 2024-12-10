<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $orderItems = OrderItem::with(['order', 'menuItem'])->get();
        return response()->json($orderItems, 200);
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'menu_item_id' => 'required|exists:menu_items,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $orderItem = OrderItem::create($validated);

        return response()->json($orderItem->load(['order', 'menuItem']), 201);
    }

    // Display the specified resource
    public function show($id)
    {
        $orderItem = OrderItem::with(['order', 'menuItem'])->find($id);

        if (!$orderItem) {
            return response()->json(['message' => 'Order item not found'], 404);
        }

        return response()->json($orderItem, 200);
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $orderItem = OrderItem::find($id);

        if (!$orderItem) {
            return response()->json(['message' => 'Order item not found'], 404);
        }

        $validated = $request->validate([
            'order_id' => 'sometimes|exists:orders,id',
            'menu_item_id' => 'sometimes|exists:menu_items,id',
            'quantity' => 'sometimes|integer|min:1',
            'price' => 'sometimes|numeric|min:0',
        ]);

        $orderItem->update($validated);

        return response()->json($orderItem->load(['order', 'menuItem']), 200);
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $orderItem = OrderItem::find($id);

        if (!$orderItem) {
            return response()->json(['message' => 'Order item not found'], 404);
        }

        $orderItem->delete();

        return response()->json(['message' => 'Order item deleted'], 204);
    }
}
