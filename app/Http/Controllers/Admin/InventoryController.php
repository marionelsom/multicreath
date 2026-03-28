<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InventoryMovement;
use App\Models\ProductVariant;
use App\Models\Supplier;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $query = ProductVariant::with('product.category');

        if ($request->filter === 'low_stock') {
            $query->whereColumn('stock', '<=', 'min_stock');
        }
        if ($request->search) {
            $query->where('sku', 'like', "%{$request->search}%")
                  ->orWhere('name', 'like', "%{$request->search}%")
                  ->orWhereHas('product', fn($q) => $q->where('name', 'like', "%{$request->search}%"));
        }

        $variants     = $query->latest()->paginate(20);
        $low_stock    = ProductVariant::whereColumn('stock', '<=', 'min_stock')->count();
        $total_value  = ProductVariant::selectRaw('SUM(stock * cost_price) as value')->value('value') ?? 0;

        return view('admin.inventory.index', compact('variants', 'low_stock', 'total_value'));
    }

    public function movements(ProductVariant $variant)
    {
        $movements = $variant->inventoryMovements()->latest()->paginate(20);
        return view('admin.inventory.movements', compact('variant', 'movements'));
    }

    public function storeMovement(Request $request)
    {
        $data = $request->validate([
            'product_variant_id' => 'required|exists:product_variants,id',
            'type'               => 'required|in:in,out,adjustment',
            'quantity'           => 'required|integer|min:1',
            'reason'             => 'nullable|string|max:255',
            'notes'              => 'nullable|string',
        ]);

        $data['user_id'] = auth()->id();
        InventoryMovement::create($data);

        return back()->with('success', 'Movimiento de inventario registrado.');
    }
}
