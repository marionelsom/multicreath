@extends('admin.layouts.app')
@section('title', $service->name)
@section('page-title', $service->name)
@section('page-subtitle', 'Detalles del servicio y paquetes')

@section('header-actions')
    <a href="{{ route('admin.services.edit', $service) }}" class="btn-ghost">
        <span class="material-symbols-outlined" style="font-size:16px;">edit</span> Editar
    </a>
    <a href="{{ route('admin.services.index') }}" class="btn-ghost">
        <span class="material-symbols-outlined" style="font-size:16px;">arrow_back</span> Volver
    </a>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

    {{-- Service info --}}
    <div class="space-y-4">
        <div class="card">
            <div style="width:48px;height:48px;border-radius:12px;background:rgba(19,91,236,0.12);display:flex;align-items:center;justify-content:center;margin-bottom:16px;">
                <span class="material-symbols-outlined text-primary" style="font-size:24px;">design_services</span>
            </div>
            <h2 style="font-size:18px; font-weight:700; color:#f0f4ff; margin-bottom:8px;">{{ $service->name }}</h2>
            @if($service->description)
            <p style="font-size:13px; color:#8896b3; margin-bottom:16px; line-height:1.6;">{{ $service->description }}</p>
            @endif
            <div class="space-y-3 pt-4 border-t border-surface-border">
                @foreach([['Categoría', $service->category->name], ['Unidad', $service->unit->name . ' (' . $service->unit->symbol . ')']] as [$label, $val])
                <div class="flex justify-between">
                    <span style="font-size:12px; color:#8896b3;">{{ $label }}</span>
                    <span style="font-size:13px; font-weight:500; color:#f0f4ff;">{{ $val }}</span>
                </div>
                @endforeach
                <div class="flex justify-between">
                    <span style="font-size:12px; color:#8896b3;">Estado</span>
                    <span class="badge" style="color:{{ $service->active ? '#10b981' : '#ef4444' }}; background:{{ $service->active ? 'rgba(16,185,129,0.12)' : 'rgba(239,68,68,0.12)' }};">
                        {{ $service->active ? 'Activo' : 'Inactivo' }}
                    </span>
                </div>
                <div class="flex justify-between border-t border-surface-border pt-3">
                    <span style="font-size:12px; color:#8896b3;">Paquetes</span>
                    <span style="font-size:18px; font-weight:700; color:#f0f4ff;">{{ $service->variants->count() }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Packages --}}
    <div class="lg:col-span-2 space-y-4">

        {{-- Add package form --}}
        <div class="card">
            <h3 style="font-size:14px; font-weight:600; color:#f0f4ff; margin-bottom:16px; display:flex; align-items:center; gap:8px;">
                <span class="material-symbols-outlined text-primary" style="font-size:18px;">add_circle</span>
                Nuevo Paquete
            </h3>
            <form method="POST" action="{{ route('admin.services.variants.store', $service) }}">
                @csrf
                <div class="grid grid-cols-2 gap-3">
                    <div class="col-span-2">
                        <label class="form-label">Nombre del Paquete *</label>
                        <input type="text" name="name" class="form-input" placeholder="Ej: Paquete Básico, Profesional, Premium" required/>
                    </div>
                    <div>
                        <label class="form-label">Costo ($) *</label>
                        <input type="number" name="cost_price" class="form-input" step="0.01" min="0" placeholder="0.00" required/>
                    </div>
                    <div>
                        <label class="form-label">Precio de Venta ($) *</label>
                        <input type="number" name="sale_price" class="form-input" step="0.01" min="0" placeholder="0.00" required/>
                    </div>
                    <div>
                        <label class="form-label">Días de Entrega *</label>
                        <input type="number" name="delivery_days" class="form-input" min="1" value="7" required/>
                    </div>
                    <div>
                        <label class="form-label">Revisiones Incluidas *</label>
                        <input type="number" name="revisions_included" class="form-input" min="0" value="2" required/>
                    </div>
                    <div class="col-span-2">
                        <label class="form-label">Características (una por línea)</label>
                        <textarea name="features" class="form-input" rows="4" placeholder="5 páginas responsive&#10;Formulario de contacto&#10;SEO básico&#10;Soporte 3 meses"></textarea>
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="submit" class="btn-primary">
                        <span class="material-symbols-outlined" style="font-size:16px;">add</span> Agregar Paquete
                    </button>
                </div>
            </form>
        </div>

        {{-- Packages list --}}
        <div class="space-y-4">
            @forelse($service->variants as $variant)
            <div class="stat-card p-5">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h4 style="font-size:16px; font-weight:700; color:#f0f4ff;">{{ $variant->name }}</h4>
                        @if($variant->sku)<p style="font-size:12px; color:#8896b3; font-family:'DM Mono',monospace;">{{ $variant->sku }}</p>@endif
                    </div>
                    <div class="text-right">
                        <p style="font-size:22px; font-weight:700; color:#10b981;">${{ number_format($variant->sale_price, 2) }}</p>
                        <p style="font-size:11px; color:#8896b3;">costo: ${{ number_format($variant->cost_price, 2) }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-6 py-3 border-t border-b border-surface-border mb-4">
                    <div class="text-center">
                        <p style="font-size:18px; font-weight:700; color:#f0f4ff;">{{ $variant->delivery_days }}</p>
                        <p style="font-size:11px; color:#8896b3;">días entrega</p>
                    </div>
                    <div class="text-center">
                        <p style="font-size:18px; font-weight:700; color:#f0f4ff;">{{ $variant->revisions_included }}</p>
                        <p style="font-size:11px; color:#8896b3;">revisiones</p>
                    </div>
                    <span class="badge" style="color:{{ $variant->active ? '#10b981' : '#ef4444' }}; background:{{ $variant->active ? 'rgba(16,185,129,0.12)' : 'rgba(239,68,68,0.12)' }};">
                        {{ $variant->active ? 'Activo' : 'Inactivo' }}
                    </span>
                </div>

                @if($variant->features && count($variant->features) > 0)
                <ul class="space-y-1">
                    @foreach($variant->features as $feature)
                    <li style="font-size:13px; color:#8896b3; display:flex; align-items:center; gap:8px;">
                        <span class="material-symbols-outlined" style="font-size:14px; color:#10b981;">check</span>
                        {{ $feature }}
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
            @empty
            <div class="card text-center py-10">
                <span class="material-symbols-outlined" style="color:#4a5568; font-size:36px;">package_2</span>
                <p style="font-size:13px; color:#8896b3; margin-top:8px;">Sin paquetes definidos. Agrega el primero arriba.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
