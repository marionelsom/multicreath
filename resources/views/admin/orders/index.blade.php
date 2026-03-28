@extends('admin.layouts.app')
@section('title', 'Órdenes')
@section('page-title', 'Órdenes')
@section('page-subtitle', 'Gestión de órdenes de compra')
@section('header-actions')
    <a href="{{ route('admin.orders.create') }}" class="btn-primary"><span class="material-symbols-outlined" style="font-size:16px;">add</span> Nueva Orden</a>
@endsection
@section('content')
<div class="card mb-4">
    <form method="GET" class="flex flex-wrap gap-3">
        <input type="text" name="search" value="{{ request('search') }}" class="form-input" style="max-width:280px;" placeholder="Buscar por número u cliente..."/>
        <select name="status" class="form-input" style="max-width:180px;">
            <option value="">Todos los estados</option>
            @foreach(['pendiente','procesando','completado','cancelado','enviado'] as $s)
                <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn-primary"><span class="material-symbols-outlined" style="font-size:16px;">search</span> Filtrar</button>
        @if(request('search') || request('status'))<a href="{{ route('admin.orders.index') }}" class="btn-ghost">Limpiar</a>@endif
    </form>
</div>

<div class="stat-card overflow-hidden">
    <table class="w-full data-table">
        <thead>
            <tr>
                <th class="text-left">Número</th>
                <th class="text-left">Cliente</th>
                <th class="text-left">Total</th>
                <th class="text-left">Pago</th>
                <th class="text-left">Estado</th>
                <th class="text-left">Fecha</th>
                <th class="text-left">Acción</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            @php
            $statusColor = ['pendiente'=>'#f59e0b,rgba(245,158,11,0.12)','procesando'=>'#135bec,rgba(19,91,236,0.12)','completado'=>'#10b981,rgba(16,185,129,0.12)','cancelado'=>'#ef4444,rgba(239,68,68,0.12)','enviado'=>'#8b5cf6,rgba(139,92,246,0.12)'];
            $payColor    = ['pendiente'=>'#f59e0b,rgba(245,158,11,0.12)','pagado'=>'#10b981,rgba(16,185,129,0.12)','parcial'=>'#8b5cf6,rgba(139,92,246,0.12)'];
            [$sc,$sb] = explode(',', $statusColor[$order->status] ?? '#8896b3,rgba(136,150,179,0.12)');
            [$pc,$pb] = explode(',', $payColor[$order->payment_status] ?? '#8896b3,rgba(136,150,179,0.12)');
            @endphp
            <tr>
                <td><a href="{{ route('admin.orders.show', $order) }}" style="color:#135bec; font-family:'DM Mono',monospace; font-size:12px;">{{ $order->order_number }}</a></td>
                <td style="font-size:13px;">{{ $order->customer->full_name }}</td>
                <td style="font-size:14px; font-weight:700;">${{ number_format($order->total, 2) }}</td>
                <td><span class="badge" style="color:{{ $pc }}; background:{{ $pb }};">{{ ucfirst($order->payment_status) }}</span></td>
                <td><span class="badge" style="color:{{ $sc }}; background:{{ $sb }};">{{ ucfirst($order->status) }}</span></td>
                <td style="font-size:12px; color:#8896b3;">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                <td><a href="{{ route('admin.orders.show', $order) }}" style="color:#8896b3;" onmouseover="this.style.color='#f0f4ff'" onmouseout="this.style.color='#8896b3'"><span class="material-symbols-outlined" style="font-size:18px;">visibility</span></a></td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center; color:#8896b3; padding:40px;">No hay órdenes</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($orders->hasPages())
    <div class="px-5 py-4 border-t border-surface-border">{{ $orders->withQueryString()->links() }}</div>
    @endif
</div>
@endsection
