@extends('admin.layouts.app')
@section('title', 'Movimientos')
@section('page-title', $variant->name)
@section('page-subtitle', 'Historial de movimientos de inventario · ' . $variant->sku)
@section('header-actions')
    <a href="{{ route('admin.inventory.index') }}" class="btn-ghost"><span class="material-symbols-outlined" style="font-size:16px;">arrow_back</span> Volver</a>
@endsection
@section('content')
<div class="grid grid-cols-3 gap-4 mb-5">
    <div class="stat-card p-5">
        <p style="font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:0.07em; color:#8896b3;">Stock Actual</p>
        <p style="font-size:32px; font-weight:700; color:{{ $variant->low_stock ? '#ef4444' : '#10b981' }}; margin-top:8px;">{{ $variant->stock }}</p>
    </div>
    <div class="stat-card p-5">
        <p style="font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:0.07em; color:#8896b3;">Precio Venta</p>
        <p style="font-size:32px; font-weight:700; color:#f0f4ff; margin-top:8px;">${{ number_format($variant->sale_price, 2) }}</p>
    </div>
    <div class="stat-card p-5">
        <p style="font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:0.07em; color:#8896b3;">Valor en Stock</p>
        <p style="font-size:32px; font-weight:700; color:#135bec; margin-top:8px;">${{ number_format($variant->stock * $variant->cost_price, 2) }}</p>
    </div>
</div>

<div class="stat-card overflow-hidden">
    <div class="px-5 py-4 border-b border-surface-border">
        <p style="font-size:14px; font-weight:600; color:#f0f4ff;">Historial de Movimientos</p>
    </div>
    <table class="w-full data-table">
        <thead><tr><th class="text-left">Tipo</th><th class="text-right">Cantidad</th><th class="text-left">Razón</th><th class="text-left">Notas</th><th class="text-left">Fecha</th></tr></thead>
        <tbody>
            @forelse($movements as $m)
            @php
            $tc = $m->type === 'in' ? '#10b981' : ($m->type === 'out' ? '#ef4444' : '#f59e0b');
            $icon = $m->type === 'in' ? 'add_circle' : ($m->type === 'out' ? 'remove_circle' : 'tune');
            $label = ['in' => 'Entrada', 'out' => 'Salida', 'adjustment' => 'Ajuste'][$m->type];
            @endphp
            <tr>
                <td>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined" style="color:{{ $tc }}; font-size:16px;">{{ $icon }}</span>
                        <span class="badge" style="color:{{ $tc }}; background:{{ $m->type==='in'?'rgba(16,185,129,0.12)':($m->type==='out'?'rgba(239,68,68,0.12)':'rgba(245,158,11,0.12)') }};">{{ $label }}</span>
                    </div>
                </td>
                <td style="text-align:right; font-size:16px; font-weight:700; color:{{ $tc }};">{{ $m->type === 'in' ? '+' : ($m->type === 'out' ? '-' : '=') }}{{ $m->quantity }}</td>
                <td style="font-size:13px; color:#f0f4ff;">{{ $m->reason ?? '—' }}</td>
                <td style="font-size:12px; color:#8896b3;">{{ $m->notes ?? '—' }}</td>
                <td style="font-size:12px; color:#8896b3;">{{ $m->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center; color:#8896b3; padding:40px;">Sin movimientos registrados</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($movements->hasPages())
    <div class="px-5 py-4 border-t border-surface-border">{{ $movements->links() }}</div>
    @endif
</div>
@endsection
