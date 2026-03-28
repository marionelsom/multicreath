<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\InventoryMovement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();

        if ($request->has('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        return $query->with('customer', 'items')->orderBy('created_at', 'desc')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_number' => 'required|string|unique:orders',
            'status' => 'required|in:pendiente,procesando,completado,cancelado,enviado',
            'subtotal' => 'required|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'payment_method' => 'nullable|in:efectivo,tarjeta,transferencia,otro',
            'payment_status' => 'required|in:pendiente,pagado,parcial',
            'shipping_address' => 'nullable|string',
            'notes' => 'nullable|string',
            'items' => 'required|array',
            'items.*.product_variant_id' => 'required|exists:product_variants,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        $order = Order::create($validated);

        // Crear items de la orden
        foreach ($validated['items'] as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_variant_id' => $item['product_variant_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'subtotal' => $item['quantity'] * $item['unit_price'],
            ]);

            // Registrar movimiento de inventario
            InventoryMovement::create([
                'product_variant_id' => $item['product_variant_id'],
                'type' => 'out',
                'quantity' => $item['quantity'],
                'reason' => 'venta',
                'reference_id' => $order->id,
            ]);
        }

        return response()->json($order->load('items'), 201);
    }

    public function show(Order $order)
    {
        return $order->load('customer', 'items.productVariant');
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'in:pendiente,procesando,completado,cancelado,enviado',
            'payment_status' => 'in:pendiente,pagado,parcial',
            'payment_method' => 'nullable|in:efectivo,tarjeta,transferencia,otro',
            'shipping_address' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $order->update($validated);
        return $order;
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(null, 204);
    }
}