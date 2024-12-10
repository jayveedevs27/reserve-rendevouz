<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $tables = Table::all();
        return response()->json($tables, 200);
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'table_number' => 'required|integer|unique:tables',
            'capacity' => 'required|integer|min:1',
            'is_available' => 'boolean',
        ]);

        $table = Table::create($validated);

        return response()->json($table, 201);
    }

    // Display the specified resource
    public function show($id)
    {
        $table = Table::find($id);

        if (!$table) {
            return response()->json(['message' => 'Table not found'], 404);
        }

        return response()->json($table, 200);
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $table = Table::find($id);

        if (!$table) {
            return response()->json(['message' => 'Table not found'], 404);
        }

        $validated = $request->validate([
            'table_number' => 'required|integer|unique:tables,table_number,' . $id,
            'capacity' => 'required|integer|min:1',
            'is_available' => 'boolean',
        ]);

        $table->update($validated);

        return response()->json($table, 200);
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $table = Table::find($id);

        if (!$table) {
            return response()->json(['message' => 'Table not found'], 404);
        }

        $table->delete();

        return response()->json(['message' => 'Table deleted'], 204);
    }
}
