@extends('admin.layouts.app')
@section('title', 'Inventario')
@section('page-title', 'Inventario')
@section('page-subtitle', 'Control de stock de variantes')
@section('content')
<div class="grid grid-cols-3 gap-4 mb-5">
    <div class="stat-card p-5">
        <p style="font-size:11px; font-weight:600; letter-spacing:0.07em; text-transform:uppercase; color:#8896b3;">Stock Bajo</p>
        <p style="font-size:28px; font-weight:700; color:#ef4444; margin-top:8px;">{{ $low_stock }}</p>
    </div>
    <div class="stat-card p-5">
        <p style="font-size:11px; font-weight:600; letter-spacing:0.07em; text-transform:uppercase; color:#8896b3;">Valor Total Inventario</p>
        <p style="font-size:28px; font-weight:700; color:#10b981; margin-top:8px;">${{ number_format($total_value, 2) }}</p>
    </div>
    <div class="stat-card p-5">
        <p style="font-size:11px; font-weight:600; letter-spacing:0.07em; text-transform:uppercase; color:#8896b3;">Total Variantes</p>
        <p style="font-size:28px; font-weight:700; color:#f0f4ff; margin-top:8px;">{{ $variants->total() }}</p>
    </div>
</div>

{{-- Ajuste rápido de inventario --}}
<div class="card mb-5">
    <h3 style="font-size:14px; font-weight:600; color:#f0f4ff; margin-bottom:16px; display:flex; align-items:center; gap:8px;">
        <span class="material-symbols-outlined text-primary" style="font-size:18px;">tune</span> Registrar Movimiento de Inventario
    </h3>
    <form method="POST" action="{{ route('admin.inventory.movement.store') }}" class="flex flex-wrap gap-3 items-end">
        @csrf
        <div style="min-width:220px;">
            <label class="form-label">Variante *</label>
            <select name="product_variant_id" class="form-input" required>
                <option value="">Seleccionar variante...</option>
                @foreach($variants as $v)
                    <option value="{{ $v->id }}" {{ request('variant') == $v->id ? 'selected' : '' }}>{{ $v->product->name }} — {{ $v->name }} ({{ $v->sku }})</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="form-label">Tipo *</label>
            <select name="type" class="form-input" style="min-width:140px;" required>
                <option value="in">Entrada (+)</option>
                <option value="out">Salida (-)</option>
                <option value="adjustment">Ajuste</option>
            </select>
        </div>
        <div>
            <label class="form-label">Cantidad *</label>
            <input type="number" name="quantity" class="form-input" style="width:100px;" min="1" placeholder="0" required/>
        </div>
        <div style="flex:1; min-width:180px;">
            <label class="form-label">Razón</label>
            <input type="text" name="reason" class="form-input" placeholder="Compra, venta manual, ajuste..."/>
        </div>
        <button type="submit" class="btn-primary"><span class="material-symbols-outlined" style="font-size:16px;">swap_vert</span> Registrar</button>
    </form>
</div>

{{-- Filters --}}
<div class="card mb-4">
    <form method="GET" class="flex flex-wrap gap-3">
        <input type="text" name="search" value="{{ request('search') }}" class="form-input" style="max-width:280px;" placeholder="Buscar por SKU, nombre..."/>
        <div class="flex gap-2">
            <a href="{{ route('admin.inventory.index') }}" class="btn-ghost {{ !request('filter') ? 'border-primary text-ink' : '' }}">Todos</a>
            <a href="{{ route('admin.inventory.index', ['filter'=>'low_stock']) }}" class="btn-ghost {{ request('filter') === 'low_stock' ? 'border-red-500 text-red-400' : '' }}">Stock Bajo</a>
        </div>
        @if(request('search'))<button type="submit" class="btn-primary"><span class="material-symbols-outlined" style="font-size:16px;">search</span></button>@endif
    </form>
</div>

<div class="stat-card overflow-hidden">
    <table class="w-full data-table">
        <thead>
            <tr>
                <th class="text-left">Variante</th>
                <th class="text-left">Producto</th>
                <th class="text-left">SKU</th>
                <th class="text-right">Costo</th>
                <th class="text-right">Precio</th>
                <th class="text-right">Stock</th>
                <th class="text-right">Mínimo</th>
                <th class="text-left">Acción</th>
            </tr>
        </thead>
        <tbody>
            @forelse($variants as $variant)
            <tr>
                <td>
                    <div class="flex items-center gap-2">
                        @if($variant->low_stock)
                            <div style="width:6px;height:6px;border-radius:50%;background:#ef4444;flex-shrink:0;"></div>
                        @endif
                        <span style="font-size:13px; font-weight:500; color:#f0f4ff;">{{ $variant->name }}</span>
                    </div>
                    @if($variant->size || $variant->color)
                    <p style="font-size:11px; color:#8896b3;">{{ implode(' / ', array_filter([$variant->size, $variant->color])) }}</p>
                    @endif
                </td>
                <td style="font-size:13px; color:#8896b3;">{{ $variant->product->name }}</td>
                <td style="font-size:12px; font-family:'DM Mono',monospace; color:#8896b3;">{{ $variant->sku }}</td>
                <td style="text-align:right; font-size:13px;">${{ number_format($variant->cost_price, 2) }}</td>
                <td style="text-align:right; font-size:13px; font-weight:600; color:#10b981;">${{ number_format($variant->sale_price, 2) }}</td>
                <td style="text-align:right; font-size:16px; font-weight:700; color:{{ $variant->low_stock ? '#ef4444' : '#f0f4ff' }};">{{ $variant->stock }}</td>
                <td style="text-align:right; font-size:12px; color:#8896b3;">{{ $variant->min_stock }}</td>
                <td>
                    <a href="{{ route('admin.inventory.movements', $variant) }}" style="font-size:12px; color:#135bec;">Historial</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="8" style="text-align:center; color:#8896b3; padding:40px;">No hay variantes</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($variants->hasPages())
    <div class="px-5 py-4 border-t border-surface-border">{{ $variants->withQueryString()->links() }}</div>
    @endif
</div>
@endsection
