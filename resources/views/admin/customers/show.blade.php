@extends('admin.layouts.app')
@section('title', $customer->full_name)
@section('page-title', $customer->full_name)
@section('page-subtitle', 'Perfil del cliente')
@section('header-actions')
    <a href="{{ route('admin.customers.edit', $customer) }}" class="btn-ghost"><span class="material-symbols-outlined" style="font-size:16px;">edit</span> Editar</a>
    <a href="{{ route('admin.customers.index') }}" class="btn-ghost"><span class="material-symbols-outlined" style="font-size:16px;">arrow_back</span> Volver</a>
@endsection
@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
    <div class="space-y-4">
        <div class="card">
            <div style="width:56px;height:56px;border-radius:50%;background:rgba(19,91,236,0.15);display:flex;align-items:center;justify-content:center;font-size:22px;font-weight:700;color:#135bec;margin-bottom:16px;">
                {{ strtoupper(substr($customer->full_name, 0, 1)) }}
            </div>
            <h2 style="font-size:18px; font-weight:700; color:#f0f4ff;">{{ $customer->full_name }}</h2>
            @if($customer->company_name)<p style="font-size:13px; color:#8896b3; margin-bottom:16px;">{{ $customer->company_name }}</p>@endif
            <div class="space-y-3 pt-4 border-t border-surface-border">
                @foreach([['Teléfono', $customer->phone], ['Email', $customer->email ?? '—'], ['Tipo', $customer->type?->name ?? '—'], ['NIT', $customer->nit ?? '—']] as [$l, $v])
                <div class="flex items-start justify-between gap-3">
                    <span style="font-size:12px; color:#8896b3; flex-shrink:0;">{{ $l }}</span>
                    <span style="font-size:13px; font-weight:500; color:#f0f4ff; text-align:right;">{{ $v }}</span>
                </div>
                @endforeach
                @if($customer->address)
                <div>
                    <p style="font-size:12px; color:#8896b3; margin-bottom:2px;">Dirección</p>
                    <p style="font-size:13px; color:#f0f4ff;">{{ $customer->address }}</p>
                </div>
                @endif
                @if($customer->credit_limit)
                <div class="border-t border-surface-border pt-3">
                    <p style="font-size:12px; color:#8896b3;">Crédito</p>
                    <div class="flex justify-between mt-1">
                        <span style="font-size:13px; color:#f0f4ff;">Usado: ${{ number_format($customer->credit_used, 2) }}</span>
                        <span style="font-size:13px; color:#10b981;">Límite: ${{ number_format($customer->credit_limit, 2) }}</span>
                    </div>
                    <div style="height:4px; background:#1e2535; border-radius:2px; margin-top:8px; overflow:hidden;">
                        @php $pct = $customer->credit_limit > 0 ? min(100, ($customer->credit_used/$customer->credit_limit)*100) : 0; @endphp
                        <div style="height:100%; width:{{ $pct }}%; background:{{ $pct > 80 ? '#ef4444' : '#135bec' }}; border-radius:2px;"></div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="lg:col-span-2 space-y-4">
        {{-- Orders summary --}}
        <div class="stat-card overflow-hidden">
            <div class="flex justify-between items-center px-5 py-4 border-b border-surface-border">
                <p style="font-size:14px; font-weight:600; color:#f0f4ff;">Órdenes ({{ $customer->orders->count() }})</p>
                <a href="{{ route('admin.orders.create') }}" class="btn-primary" style="padding:6px 12px; font-size:12px;">+ Nueva Orden</a>
            </div>
            <table class="w-full data-table">
                <thead><tr><th class="text-left">Número</th><th class="text-left">Total</th><th class="text-left">Estado</th><th class="text-left">Fecha</th></tr></thead>
                <tbody>
                    @forelse($customer->orders->take(5) as $order)
                    <tr>
                        <td><a href="{{ route('admin.orders.show', $order) }}" style="color:#135bec; font-family:'DM Mono',monospace; font-size:12px;">{{ $order->order_number }}</a></td>
                        <td style="font-size:14px; font-weight:600;">${{ number_format($order->total, 2) }}</td>
                        <td><span class="badge" style="color:#f59e0b; background:rgba(245,158,11,0.12);">{{ ucfirst($order->status) }}</span></td>
                        <td style="font-size:12px; color:#8896b3;">{{ $order->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" style="text-align:center; color:#8896b3; padding:20px;">Sin órdenes</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Projects summary --}}
        <div class="stat-card overflow-hidden">
            <div class="flex justify-between items-center px-5 py-4 border-b border-surface-border">
                <p style="font-size:14px; font-weight:600; color:#f0f4ff;">Proyectos ({{ $customer->projects->count() }})</p>
                <a href="{{ route('admin.projects.create') }}" class="btn-primary" style="padding:6px 12px; font-size:12px;">+ Nuevo Proyecto</a>
            </div>
            <div class="divide-y divide-surface-border">
                @forelse($customer->projects->take(5) as $project)
                <a href="{{ route('admin.projects.show', $project) }}" class="flex items-center justify-between px-5 py-3 hover:bg-surface-hover transition-colors block">
                    <p style="font-size:13px; font-weight:500; color:#f0f4ff;">{{ $project->title }}</p>
                    <span class="badge" style="color:#f59e0b; background:rgba(245,158,11,0.12);">{{ ucfirst(str_replace('_',' ',$project->status)) }}</span>
                </a>
                @empty
                <p style="text-align:center; color:#8896b3; padding:20px; font-size:13px;">Sin proyectos</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
