<?php

namespace App\Http\Controllers\Api;

use App\Models\ProductVariant;
use App\Models\InventoryMovement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductVariantController extends Controller
{
    public function index(Request $request)
    {
        $query = ProductVariant::query();

        if ($request->has('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        if ($request->has('sku')) {
            $query->where('sku', $request->sku);
        }

        return $query->with('product')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required|string',
            'sku' => 'required|string|unique:product_variants',
            'size' => 'nullable|string',
            'color' => 'required|string',
            'material' => 'nullable|string',
            'sublimation_type' => 'nullable|in:DTF,Sublimación,Directo,Otro',
            'cost_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $variant = ProductVariant::create($validated);

        // Registrar movimiento de inventario
        InventoryMovement::create([
            'product_variant_id' => $variant->id,
            'type' => 'in',
            'quantity' => $variant->stock,
            'reason' => 'compra',
        ]);

        return response()->json($variant, 201);
    }

    public function show(ProductVariant $productVariant)
    {
        return $productVariant->load('product', 'inventoryMovements');
    }

    public function update(Request $request, ProductVariant $productVariant)
    {
        $validated = $request->validate([
            'name' => 'string',
            'sku' => 'string|unique:product_variants,sku,' . $productVariant->id,
            'size' => 'nullable|string',
            'color' => 'string',
            'material' => 'nullable|string',
            'sublimation_type' => 'nullable|in:DTF,Sublimación,Directo,Otro',
            'cost_price' => 'numeric|min:0',
            'sale_price' => 'numeric|min:0',
            'stock' => 'integer|min:0',
        ]);

        // Si cambia el stock, registrar movimiento
        if (isset($validated['stock']) && $validated['stock'] != $productVariant->stock) {
            $difference = $validated['stock'] - $productVariant->stock;
            $type = $difference > 0 ? 'in' : 'out';

            InventoryMovement::create([
                'product_variant_id' => $productVariant->id,
                'type' => $type,
                'quantity' => abs($difference),
                'reason' => 'ajuste',
            ]);
        }

        $productVariant->update($validated);
        return $productVariant;
    }

    public function destroy(ProductVariant $productVariant)
    {
        $productVariant->delete();
        return response()->json(null, 204);
    }
}