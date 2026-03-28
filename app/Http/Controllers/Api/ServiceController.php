<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query();

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        return $query->with('category', 'unit', 'variants')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'unit_id' => 'required|exists:units,id',
            'description' => 'nullable|string',
        ]);

        $service = Service::create($validated);
        return response()->json($service, 201);
    }

    public function show(Service $service)
    {
        return $service->load('category', 'unit', 'variants');
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'string',
            'category_id' => 'exists:categories,id',
            'unit_id' => 'exists:units,id',
            'description' => 'nullable|string',
        ]);

        $service->update($validated);
        return $service;
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return response()->json(null, 204);
    }
}