@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Resumen general de MULTICREATH')

@section('header-actions')
    <span class="text-xs text-ink-faint">{{ now()->format('d M Y, H:i') }}</span>
@endsection

@section('content')

{{-- Stats Grid --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

    @php
    $statsCards = [
        ['label' => 'Órdenes Hoy',      'value' => $stats['orders_today'],    'icon' => 'receipt_long',   'color' => '#135bec', 'bg' => 'rgba(19,91,236,0.12)'],
        ['label' => 'Órdenes Totales',  'value' => $stats['total_orders'],    'icon' => 'shopping_cart',  'color' => '#8b5cf6', 'bg' => 'rgba(139,92,246,0.12)'],
        ['label' => 'Clientes Activos', 'value' => $stats['total_customers'], 'icon' => 'group',          'color' => '#10b981', 'bg' => 'rgba(16,185,129,0.12)'],
        ['label' => 'Proyectos Activos','value' => $stats['active_projects'], 'icon' => 'folder_open',    'color' => '#f59e0b', 'bg' => 'rgba(245,158,11,0.12)'],
    ];
    @endphp

    @foreach($statsCards as $s)
    <div class="stat-card p-5">
        <div class="flex items-start justify-between">
            <div>
                <p style="font-size:11px; font-weight:600; letter-spacing:0.07em; text-transform:uppercase; color:#8896b3;">{{ $s['label'] }}</p>
                <p style="font-size:28px; font-weight:700; color:#f0f4ff; margin-top:8px; line-height:1;">{{ $s['value'] }}</p>
            </div>
            <div style="width:40px; height:40px; border-radius:10px; background:{{ $s['bg'] }}; display:flex; align-items:center; justify-content:center; color:{{ $s['color'] }}; flex-shrink:0;">
                <span class="material-symbols-outlined">{{ $s['icon'] }}</span>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- Secondary stats --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">
    <div class="stat-card p-5">
        <p style="font-size:11px; font-weight:600; letter-spacing:0.07em; text-transform:uppercase; color:#8896b3;">Ingresos del Mes</p>
        <p style="font-size:26px; font-weight:700; color:#10b981; margin-top:8px;">${{ number_format($stats['revenue_month'], 2) }}</p>
        <p style="font-size:12px; color:#8896b3; margin-top:4px;">Órdenes pagadas</p>
    </div>
    <div class="stat-card p-5">
        <p style="font-size:11px; font-weight:600; letter-spacing:0.07em; text-transform:uppercase; color:#8896b3;">Órdenes Pendientes</p>
        <p style="font-size:26px; font-weight:700; color:#f59e0b; margin-top:8px;">{{ $stats['pending_orders'] }}</p>
        <p style="font-size:12px; color:#8896b3; margin-top:4px;">Requieren atención</p>
    </div>
    <div class="stat-card p-5">
        <p style="font-size:11px; font-weight:600; letter-spacing:0.07em; text-transform:uppercase; color:#8896b3;">Stock Bajo</p>
        <p style="font-size:26px; font-weight:700; color:#ef4444; margin-top:8px;">{{ $stats['low_stock_count'] }}</p>
        <p style="font-size:12px; color:#8896b3; margin-top:4px;">Variantes bajo mínimo</p>
    </div>
</div>

{{-- Revenue chart + Recent orders --}}
<div class="grid grid-cols-1 lg:grid-cols-5 gap-4 mb-6">

    {{-- Chart --}}
    <div class="stat-card p-5 lg:col-span-3">
        <div class="flex items-center justify-between mb-5">
            <div>
                <p class="text-sm font-semibold text-ink">Actividad (7 días)</p>
                <p class="text-xs text-ink-faint">Ingresos y órdenes diarias</p>
            </div>
        </div>
        <div class="flex items-end gap-2 h-32">
            @php $maxRev = max(array_column($revenue_chart, 'revenue')) ?: 1; @endphp
            @foreach($revenue_chart as $day)
            <div class="flex-1 flex flex-col items-center gap-1">
                <div class="w-full rounded-t flex flex-col justify-end" style="height:96px;">
                    <div class="w-full rounded transition-all" style="height:{{ max(4, ($day['revenue']/$maxRev)*96) }}px; background:linear-gradient(to top, #135bec, #3b60f5);"></div>
                </div>
                <span style="font-size:10px; color:#8896b3;">{{ $day['date'] }}</span>
            </div>
            @endforeach
        </div>
        <div class="flex items-center gap-4 mt-4 pt-4 border-t border-surface-border">
            @foreach($revenue_chart as $day)
            @if($day['orders'] > 0)
            <div>
                <p style="font-size:10px; color:#8896b3;">{{ $day['date'] }}</p>
                <p style="font-size:12px; font-weight:600; color:#f0f4ff;">{{ $day['orders'] }} órdenes</p>
            </div>
            @endif
            @endforeach
        </div>
    </div>

    {{-- Low stock alert --}}
    <div class="stat-card p-5 lg:col-span-2">
        <div class="flex items-center justify-between mb-4">
            <p class="text-sm font-semibold text-ink">Stock Bajo</p>
            <a href="{{ route('admin.inventory.index', ['filter' => 'low_stock']) }}" style="font-size:12px; color:#135bec;">Ver todos →</a>
        </div>
        <div class="space-y-3">
            @forelse($low_stock as $v)
            <div class="flex items-center justify-between py-2 border-b border-surface-border last:border-0">
                <div class="min-w-0">
                    <p style="font-size:13px; font-weight:500; color:#f0f4ff;" class="truncate">{{ $v->product->name }}</p>
                    <p style="font-size:11px; color:#8896b3;">{{ $v->sku }}</p>
                </div>
                <div class="text-right flex-shrink-0 ml-3">
                    <p style="font-size:14px; font-weight:700; color:#ef4444;">{{ $v->stock }}</p>
                    <p style="font-size:11px; color:#8896b3;">/ {{ $v->min_stock }} mín</p>
                </div>
            </div>
            @empty
            <div class="text-center py-6">
                <span class="material-symbols-outlined" style="color:#10b981; font-size:32px;">inventory</span>
                <p style="font-size:13px; color:#8896b3; margin-top:8px;">Todo el stock en nivel óptimo</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

{{-- Recent Orders + Active Projects --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

    {{-- Recent Orders --}}
    <div class="stat-card overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-surface-border">
            <p class="text-sm font-semibold text-ink">Órdenes Recientes</p>
            <a href="{{ route('admin.orders.index') }}" style="font-size:12px; color:#135bec;">Ver todas →</a>
        </div>
        <table class="w-full data-table">
            <thead>
                <tr>
                    <th class="text-left">Orden</th>
                    <th class="text-left">Cliente</th>
                    <th class="text-left">Total</th>
                    <th class="text-left">Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recent_orders as $order)
                <tr>
                    <td>
                        <a href="{{ route('admin.orders.show', $order) }}" style="color:#135bec; font-size:13px; font-family:'DM Mono',monospace;">{{ $order->order_number }}</a>
                    </td>
                    <td style="font-size:13px;">{{ $order->customer->full_name }}</td>
                    <td style="font-size:13px; font-weight:600;">${{ number_format($order->total, 2) }}</td>
                    <td>
                        @php
                        $colors = ['pendiente'=>'#f59e0b,rgba(245,158,11,0.15)', 'procesando'=>'#135bec,rgba(19,91,236,0.15)', 'completado'=>'#10b981,rgba(16,185,129,0.15)', 'cancelado'=>'#ef4444,rgba(239,68,68,0.15)', 'enviado'=>'#8b5cf6,rgba(139,92,246,0.15)'];
                        [$tc, $bg] = explode(',', $colors[$order->status] ?? '#8896b3,rgba(136,150,179,0.15)');
                        @endphp
                        <span class="badge" style="color:{{ $tc }}; background:{{ $bg }};">{{ ucfirst($order->status) }}</span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" style="text-align:center; color:#8896b3; padding:24px;">Sin órdenes recientes</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Active Projects --}}
    <div class="stat-card overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-surface-border">
            <p class="text-sm font-semibold text-ink">Proyectos Activos</p>
            <a href="{{ route('admin.projects.index') }}" style="font-size:12px; color:#135bec;">Ver todos →</a>
        </div>
        <div class="divide-y divide-surface-border">
            @forelse($active_projects as $project)
            <a href="{{ route('admin.projects.show', $project) }}" class="flex items-center gap-4 px-5 py-4 hover:bg-surface-hover transition-colors block">
                <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined text-primary" style="font-size:18px;">folder_open</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p style="font-size:13px; font-weight:500; color:#f0f4ff;" class="truncate">{{ $project->title }}</p>
                    <p style="font-size:12px; color:#8896b3;">{{ $project->customer->full_name }}</p>
                </div>
                <div class="flex-shrink-0">
                    @php $pc = $project->status === 'en_proceso' ? '#10b981,rgba(16,185,129,0.15)' : '#f59e0b,rgba(245,158,11,0.15)';
                    [$ptc, $pbg] = explode(',', $pc); @endphp
                    <span class="badge" style="color:{{ $ptc }}; background:{{ $pbg }};">{{ ucfirst(str_replace('_', ' ', $project->status)) }}</span>
                </div>
            </a>
            @empty
            <div class="text-center py-10">
                <span class="material-symbols-outlined" style="color:#4a5568; font-size:32px;">folder_open</span>
                <p style="font-size:13px; color:#8896b3; margin-top:8px;">Sin proyectos activos</p>
            </div>
            @endforelse
        </div>
    </div>

</div>
@endsection
