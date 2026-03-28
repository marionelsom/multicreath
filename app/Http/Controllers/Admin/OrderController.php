<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Customer;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('customer');
        if ($request->search) {
            $query->where('order_number', 'like', "%{$request->search}%")
                  ->orWhereHas('customer', fn($q) => $q->where('full_name', 'like', "%{$request->search}%"));
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        $orders = $query->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::where('active', true)->orderBy('full_name')->get();
        $variants  = ProductVariant::with('product')->where('active', true)->where('stock', '>', 0)->get();
        return view('admin.orders.create', compact('customers', 'variants'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id'    => 'required|exists:customers,id',
            'payment_method' => 'nullable|in:efectivo,tarjeta,transferencia',
            'notes'          => 'nullable|string',
            'items'          => 'required|array|min:1',
            'items.*.variant_id' => 'required|exists:product_variants,id',
            'items.*.quantity'   => 'required|integer|min:1',
            'items.*.price'      => 'required|numeric|min:0',
        ]);

        $order = Order::create([
            'customer_id'    => $data['customer_id'],
            'payment_method' => $data['payment_method'] ?? null,
            'notes'          => $data['notes'] ?? null,
            'status'         => 'pendiente',
            'payment_status' => 'pendiente',
            'subtotal'       => 0,
            'tax'            => 0,
            'total'          => 0,
        ]);

        $subtotal = 0;
        foreach ($data['items'] as $item) {
            $lineTotal = $item['quantity'] * $item['price'];
            $subtotal += $lineTotal;
            $order->items()->create([
                'product_variant_id' => $item['variant_id'],
                'quantity'           => $item['quantity'],
                'unit_price'         => $item['price'],
                'subtotal'           => $lineTotal,
            ]);
        }

        $tax   = $subtotal * 0.13; // IVA El Salvador
        $total = $subtotal + $tax;
        $order->update(['subtotal' => $subtotal, 'tax' => $tax, 'total' => $total]);

        return redirect()->route('admin.orders.show', $order)->with('success', 'Orden creada exitosamente.');
    }

    public function show(Order $order)
    {
        $order->load(['customer', 'items.variant.product', 'invoices']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate(['status' => 'required|in:pendiente,procesando,completado,cancelado,enviado']);
        $order->update(['status' => $request->status]);
        return back()->with('success', 'Estado actualizado.');
    }

    public function updatePayment(Request $request, Order $order)
    {
        $request->validate(['payment_status' => 'required|in:pendiente,pagado,parcial']);
        $order->update(['payment_status' => $request->payment_status]);
        return back()->with('success', 'Estado de pago actualizado.');
    }
}
