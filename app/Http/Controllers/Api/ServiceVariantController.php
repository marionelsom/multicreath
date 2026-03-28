<?php

namespace App\Http\Controllers\Api;

use App\Models\ServiceVariant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceVariantController extends Controller
{
    public function index(Request $request)
    {
        $query = ServiceVariant::query();

        if ($request->has('service_id')) {
            $query->where('service_id', $request->service_id);
        }

        return $query->with('service')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'name' => 'required|string',
            'sku' => 'required|string|unique:service_variants',
            'cost_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'features' => 'nullable|json',
            'delivery_days' => 'required|integer|min:1',
            'revisions_included' => 'required|integer|min:0',
        ]);

        $variant = ServiceVariant::create($validated);
        return response()->json($variant, 201);
    }

    public function show(ServiceVariant $serviceVariant)
    {
        return $serviceVariant->load('service');
    }

    public function update(Request $request, ServiceVariant $serviceVariant)
    {
        $validated = $request->validate([
            'name' => 'string',
            'sku' => 'string|unique:service_variants,sku,' . $serviceVariant->id,
            'cost_price' => 'numeric|min:0',
            'sale_price' => 'numeric|min:0',
            'features' => 'nullable|json',
            'delivery_days' => 'integer|min:1',
            'revisions_included' => 'integer|min:0',
        ]);

        $serviceVariant->update($validated);
        return $serviceVariant;
    }

    public function destroy(ServiceVariant $serviceVariant)
    {
        $serviceVariant->delete();
        return response()->json(null, 204);
    }
}