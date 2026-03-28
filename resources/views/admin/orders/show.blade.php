@extends('admin.layouts.app')
@section('title', $order->order_number)
@section('page-title', 'Orden: ' . $order->order_number)
@section('page-subtitle', 'Detalle y gestión de la orden')
@section('header-actions')
    <a href="{{ route('admin.orders.index') }}" class="btn-ghost"><span class="material-symbols-outlined" style="font-size:16px;">arrow_back</span> Volver</a>
@endsection
@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

    {{-- Items --}}
    <div class="lg:col-span-2 space-y-4">
        <div class="stat-card overflow-hidden">
            <div class="px-5 py-4 border-b border-surface-border">
                <p style="font-size:14px; font-weight:600; color:#f0f4ff;">Productos de la Orden</p>
            </div>
            <table class="w-full data-table">
                <thead><tr><th class="text-left">Producto</th><th class="text-left">SKU</th><th class="text-right">Cant.</th><th class="text-right">Precio</th><th class="text-right">Subtotal</th></tr></thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>
                            <p style="font-size:13px; font-weight:500; color:#f0f4ff;">{{ $item->variant->product->name }}</p>
                            <p style="font-size:12px; color:#8896b3;">{{ $item->variant->name }}</p>
                        </td>
                        <td style="font-size:12px; color:#8896b3; font-family:'DM Mono',monospace;">{{ $item->variant->sku }}</td>
                        <td style="text-align:right; font-size:14px; font-weight:600;">{{ $item->quantity }}</td>
                        <td style="text-align:right; font-size:13px;">${{ number_format($item->unit_price, 2) }}</td>
                        <td style="text-align:right; font-size:14px; font-weight:700; color:#f0f4ff;">${{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="px-5 py-4 border-t border-surface-border space-y-2">
                <div class="flex justify-between text-sm"><span style="color:#8896b3;">Subtotal</span><span>${{ number_format($order->subtotal, 2) }}</span></div>
                <div class="flex justify-between text-sm"><span style="color:#8896b3;">IVA (13%)</span><span>${{ number_format($order->tax, 2) }}</span></div>
                <div class="flex justify-between" style="padding-top:8px; border-top:1px solid #1e2535; margin-top:4px;">
                    <span style="font-size:16px; font-weight:700; color:#f0f4ff;">Total</span>
                    <span style="font-size:20px; font-weight:700; color:#10b981;">${{ number_format($order->total, 2) }}</span>
                </div>
            </div>
        </div>

        @if($order->notes)
        <div class="card">
            <p class="form-label">Notas</p>
            <p style="font-size:13px; color:#8896b3;">{{ $order->notes }}</p>
        </div>
        @endif
    </div>

    {{-- Sidebar --}}
    <div class="space-y-4">
        {{-- Customer --}}
        <div class="card">
            <p class="form-label mb-3">Cliente</p>
            <a href="{{ route('admin.customers.show', $order->customer) }}" style="display:flex; align-items:center; gap:12px;">
                <div style="width:40px;height:40px;border-radius:50%;background:rgba(19,91,236,0.15);display:flex;align-items:center;justify-content:center;font-size:16px;font-weight:700;color:#135bec;flex-shrink:0;">{{ strtoupper(substr($order->customer->full_name, 0, 1)) }}</div>
                <div>
                    <p style="font-size:14px; font-weight:600; color:#f0f4ff;">{{ $order->customer->full_name }}</p>
                    <p style="font-size:12px; color:#8896b3;">{{ $order->customer->phone }}</p>
                </div>
            </a>
        </div>

        {{-- Order Status --}}
        <div class="card">
            <p class="form-label mb-3">Estado de la Orden</p>
            @php $statusColor = ['pendiente'=>'#f59e0b','procesando'=>'#135bec','completado'=>'#10b981','cancelado'=>'#ef4444','enviado'=>'#8b5cf6']; @endphp
            <div class="flex items-center gap-2 mb-4">
                <div style="width:8px;height:8px;border-radius:50%;background:{{ $statusColor[$order->status] ?? '#8896b3' }};"></div>
                <span style="font-size:14px; font-weight:600; color:#f0f4ff;">{{ ucfirst($order->status) }}</span>
            </div>
            <form method="POST" action="{{ route('admin.orders.status', $order) }}">
                @csrf @method('PATCH')
                <div class="flex gap-2">
                    <select name="status" class="form-input" style="flex:1;">
                        @foreach(['pendiente','procesando','completado','cancelado','enviado'] as $s)
                            <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn-primary" style="padding:8px 12px; flex-shrink:0;"><span class="material-symbols-outlined" style="font-size:16px;">check</span></button>
                </div>
            </form>
        </div>

        {{-- Payment Status --}}
        <div class="card">
            <p class="form-label mb-3">Estado de Pago</p>
            @php $payColor = ['pendiente'=>'#f59e0b','pagado'=>'#10b981','parcial'=>'#8b5cf6']; @endphp
            <div class="flex items-center gap-2 mb-4">
                <div style="width:8px;height:8px;border-radius:50%;background:{{ $payColor[$order->payment_status] ?? '#8896b3' }};"></div>
                <span style="font-size:14px; font-weight:600; color:#f0f4ff;">{{ ucfirst($order->payment_status) }}</span>
                @if($order->payment_method)<span style="font-size:12px; color:#8896b3;">({{ ucfirst($order->payment_method) }})</span>@endif
            </div>
            <form method="POST" action="{{ route('admin.orders.payment', $order) }}">
                @csrf @method('PATCH')
                <div class="flex gap-2">
                    <select name="payment_status" class="form-input" style="flex:1;">
                        @foreach(['pendiente','pagado','parcial'] as $s)
                            <option value="{{ $s }}" {{ $order->payment_status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn-primary" style="padding:8px 12px; flex-shrink:0;"><span class="material-symbols-outlined" style="font-size:16px;">check</span></button>
                </div>
            </form>
        </div>

        {{-- Dates --}}
        <div class="card space-y-2">
            <div class="flex justify-between"><span style="font-size:12px; color:#8896b3;">Creada</span><span style="font-size:12px; color:#f0f4ff;">{{ $order->created_at->format('d/m/Y H:i') }}</span></div>
            <div class="flex justify-between"><span style="font-size:12px; color:#8896b3;">Actualizada</span><span style="font-size:12px; color:#f0f4ff;">{{ $order->updated_at->format('d/m/Y H:i') }}</span></div>
        </div>
    </div>
</div>
@endsection
