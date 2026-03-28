@extends('admin.layouts.app')
@section('title', 'Servicios')
@section('page-title', 'Servicios')
@section('page-subtitle', 'Catálogo de servicios de agencia')

@section('header-actions')
    <a href="{{ route('admin.services.create') }}" class="btn-primary">
        <span class="material-symbols-outlined" style="font-size:16px;">add</span> Nuevo Servicio
    </a>
@endsection

@section('content')
<div class="card mb-4">
    <form method="GET" class="flex flex-wrap gap-3">
        <input type="text" name="search" value="{{ request('search') }}" class="form-input" style="max-width:320px;" placeholder="Buscar servicios..."/>
        <button type="submit" class="btn-primary"><span class="material-symbols-outlined" style="font-size:16px;">search</span> Buscar</button>
        @if(request('search'))<a href="{{ route('admin.services.index') }}" class="btn-ghost">Limpiar</a>@endif
    </form>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse($services as $service)
    <div class="stat-card p-5 hover:border-primary/30 transition-colors">
        <div class="flex items-start justify-between mb-4">
            <div style="width:44px;height:44px;border-radius:10px;background:rgba(19,91,236,0.1);display:flex;align-items:center;justify-content:center;">
                <span class="material-symbols-outlined text-primary" style="font-size:22px;">design_services</span>
            </div>
            <span class="badge" style="color:{{ $service->active ? '#10b981' : '#ef4444' }}; background:{{ $service->active ? 'rgba(16,185,129,0.12)' : 'rgba(239,68,68,0.12)' }};">
                {{ $service->active ? 'Activo' : 'Inactivo' }}
            </span>
        </div>

        <h3 style="font-size:16px; font-weight:700; color:#f0f4ff; margin-bottom:4px;">{{ $service->name }}</h3>
        <p style="font-size:12px; color:#8896b3; margin-bottom:4px;">{{ $service->category->name }}</p>
        @if($service->description)
        <p style="font-size:12px; color:#8896b3; margin-bottom:12px;">{{ Str::limit($service->description, 80) }}</p>
        @endif

        {{-- Paquetes --}}
        <div class="space-y-2 mb-4">
            @foreach($service->variants->take(3) as $variant)
            <div class="flex items-center justify-between py-2 border-b border-surface-border last:border-0">
                <span style="font-size:12px; color:#f0f4ff;">{{ $variant->name }}</span>
                <span style="font-size:13px; font-weight:700; color:#10b981;">${{ number_format($variant->sale_price, 2) }}</span>
            </div>
            @endforeach
            @if($service->variants->count() === 0)
            <p style="font-size:12px; color:#4a5568; font-style:italic;">Sin paquetes definidos</p>
            @endif
        </div>

        <div class="flex items-center justify-between pt-3 border-t border-surface-border">
            <span style="font-size:12px; color:#8896b3;">{{ $service->variants->count() }} paquete(s)</span>
            <div class="flex gap-2">
                <a href="{{ route('admin.services.show', $service) }}"
                   style="font-size:12px; color:#135bec;">Ver detalles →</a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-3 text-center py-16">
        <span class="material-symbols-outlined" style="font-size:48px; color:#4a5568;">design_services</span>
        <p style="color:#8896b3; margin-top:8px;">No hay servicios registrados</p>
        <a href="{{ route('admin.services.create') }}" class="btn-primary" style="margin-top:12px; display:inline-flex;">Crear primer servicio</a>
    </div>
    @endforelse
</div>

@if($services->hasPages())
<div class="mt-4">{{ $services->withQueryString()->links() }}</div>
@endif
@endsection
