<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TableReservation;
use Illuminate\Http\Request;

class TableReservationController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $reservations = TableReservation::with(['user', 'table'])->get();
        return response()->json($reservations, 200);
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'table_id' => 'required|exists:tables,id',
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required|date_format:H:i',
            'status' => 'required|string|in:pending,confirmed,canceled',
        ]);

        $reservation = TableReservation::create($validated);

        return response()->json($reservation->load(['user', 'table']), 201);
    }

    // Display the specified resource
    public function show($id)
    {
        $reservation = TableReservation::with(['user', 'table'])->find($id);

        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        return response()->json($reservation, 200);
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $reservation = TableReservation::find($id);

        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'table_id' => 'sometimes|exists:tables,id',
            'reservation_date' => 'sometimes|date|after_or_equal:today',
            'reservation_time' => 'sometimes|date_format:H:i',
            'status' => 'sometimes|string|in:pending,confirmed,canceled',
        ]);

        $reservation->update($validated);

        return response()->json($reservation->load(['user', 'table']), 200);
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $reservation = TableReservation::find($id);

        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        $reservation->delete();

        return response()->json(['message' => 'Reservation deleted'], 204);
    }
}
