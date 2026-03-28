@extends('admin.layouts.app')
@section('title', 'Clientes')
@section('page-title', 'Clientes')
@section('page-subtitle', 'Base de datos de clientes')

@section('header-actions')
    <a href="{{ route('admin.customers.create') }}" class="btn-primary">
        <span class="material-symbols-outlined" style="font-size:16px;">add</span> Nuevo Cliente
    </a>
@endsection

@section('content')
<div class="card mb-4">
    <form method="GET" class="flex flex-wrap gap-3">
        <input type="text" name="search" value="{{ request('search') }}" class="form-input" style="max-width:320px;" placeholder="Buscar por nombre, email o teléfono..."/>
        <button type="submit" class="btn-primary"><span class="material-symbols-outlined" style="font-size:16px;">search</span> Buscar</button>
        @if(request('search'))<a href="{{ route('admin.customers.index') }}" class="btn-ghost">Limpiar</a>@endif
    </form>
</div>

<div class="stat-card overflow-hidden">
    <table class="w-full data-table">
        <thead>
            <tr>
                <th class="text-left">Cliente</th>
                <th class="text-left">Contacto</th>
                <th class="text-left">Tipo</th>
                <th class="text-left">Órdenes</th>
                <th class="text-left">Estado</th>
                <th class="text-left">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($customers as $customer)
            <tr>
                <td>
                    <div class="flex items-center gap-3">
                        <div style="width:36px;height:36px;border-radius:50%;background:rgba(19,91,236,0.15);display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:700;color:#135bec;flex-shrink:0;">
                            {{ strtoupper(substr($customer->full_name, 0, 1)) }}
                        </div>
                        <div>
                            <p style="font-size:14px; font-weight:500; color:#f0f4ff;">{{ $customer->full_name }}</p>
                            @if($customer->company_name)<p style="font-size:12px; color:#8896b3;">{{ $customer->company_name }}</p>@endif
                        </div>
                    </div>
                </td>
                <td>
                    <p style="font-size:13px; color:#f0f4ff;">{{ $customer->phone }}</p>
                    @if($customer->email)<p style="font-size:12px; color:#8896b3;">{{ $customer->email }}</p>@endif
                </td>
                <td style="font-size:13px; color:#8896b3;">{{ $customer->type?->name ?? '—' }}</td>
                <td style="font-size:14px; font-weight:600; color:#f0f4ff;">{{ $customer->orders->count() }}</td>
                <td>
                    <span class="badge" style="color:{{ $customer->active ? '#10b981' : '#ef4444' }}; background:{{ $customer->active ? 'rgba(16,185,129,0.12)' : 'rgba(239,68,68,0.12)' }};">
                        {{ $customer->active ? 'Activo' : 'Inactivo' }}
                    </span>
                </td>
                <td>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.customers.show', $customer) }}" style="color:#8896b3;" onmouseover="this.style.color='#f0f4ff'" onmouseout="this.style.color='#8896b3'">
                            <span class="material-symbols-outlined" style="font-size:18px;">visibility</span>
                        </a>
                        <a href="{{ route('admin.customers.edit', $customer) }}" style="color:#8896b3;" onmouseover="this.style.color='#135bec'" onmouseout="this.style.color='#8896b3'">
                            <span class="material-symbols-outlined" style="font-size:18px;">edit</span>
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center py-12" style="color:#8896b3;">No hay clientes registrados</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($customers->hasPages())
    <div class="px-5 py-4 border-t border-surface-border">{{ $customers->withQueryString()->links() }}</div>
    @endif
</div>
@endsection
