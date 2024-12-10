<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DeliveryDetail;
use Illuminate\Http\Request;

class DeliveryDetailController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $deliveryDetails = DeliveryDetail::with(['order', 'deliveryPerson'])->get();
        return response()->json($deliveryDetails, 200);
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'delivery_person_id' => 'required|exists:users,id',
            'status' => 'required|string|in:pending,dispatched,delivered,canceled',
            'delivery_time' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $deliveryDetail = DeliveryDetail::create($validated);

        return response()->json($deliveryDetail->load(['order', 'deliveryPerson']), 201);
    }

    // Display the specified resource
    public function show($id)
    {
        $deliveryDetail = DeliveryDetail::with(['order', 'deliveryPerson'])->find($id);

        if (!$deliveryDetail) {
            return response()->json(['message' => 'Delivery detail not found'], 404);
        }

        return response()->json($deliveryDetail, 200);
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $deliveryDetail = DeliveryDetail::find($id);

        if (!$deliveryDetail) {
            return response()->json(['message' => 'Delivery detail not found'], 404);
        }

        $validated = $request->validate([
            'order_id' => 'sometimes|exists:orders,id',
            'delivery_person_id' => 'sometimes|exists:users,id',
            'status' => 'sometimes|string|in:pending,dispatched,delivered,canceled',
            'delivery_time' => 'sometimes|date_format:Y-m-d H:i:s',
        ]);

        $deliveryDetail->update($validated);

        return response()->json($deliveryDetail->load(['order', 'deliveryPerson']), 200);
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $deliveryDetail = DeliveryDetail::find($id);

        if (!$deliveryDetail) {
            return response()->json(['message' => 'Delivery detail not found'], 404);
        }

        $deliveryDetail->delete();

        return response()->json(['message' => 'Delivery detail deleted'], 204);
    }
}
