<?php

namespace App\Http\Controllers\Api;

use App\Models\InventoryMovement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InventoryMovementController extends Controller
{
    public function index(Request $request)
    {
        $query = InventoryMovement::query();

        if ($request->has('product_variant_id')) {
            $query->where('product_variant_id', $request->product_variant_id);
        }

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        return $query->with('productVariant')->orderBy('created_at', 'desc')->get();
    }

    public function show(InventoryMovement $inventoryMovement)
    {
        return $inventoryMovement->load('productVariant');
    }
}