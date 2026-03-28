<?php

namespace App\Http\Controllers\Api;

use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UnitController extends Controller
{
    public function index()
    {
        return Unit::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'symbol' => 'required|string|unique:units',
        ]);

        $unit = Unit::create($validated);
        return response()->json($unit, 201);
    }

    public function show(Unit $unit)
    {
        return $unit;
    }

    public function update(Request $request, Unit $unit)
    {
        $validated = $request->validate([
            'name' => 'string',
            'symbol' => 'string|unique:units,symbol,' . $unit->id,
        ]);

        $unit->update($validated);
        return $unit;
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();
        return response()->json(null, 204);
    }
}