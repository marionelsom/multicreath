@extends('admin.layouts.app')
@section('title', $product->name)
@section('page-title', $product->name)
@section('page-subtitle', 'Detalle del producto y variantes')

@section('header-actions')
    <a href="{{ route('admin.products.edit', $product) }}" class="btn-ghost">
        <span class="material-symbols-outlined" style="font-size:16px;">edit</span> Editar
    </a>
    <a href="{{ route('admin.products.index') }}" class="btn-ghost">
        <span class="material-symbols-outlined" style="font-size:16px;">arrow_back</span> Volver
    </a>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

    {{-- Product Info --}}
    <div class="lg:col-span-1 space-y-4">
        <div class="card">
            @if($product->image_url)
                <img src="{{ $product->image_url }}" class="w-full aspect-square object-cover rounded-lg mb-4" alt="{{ $product->name }}"/>
            @else
                <div style="aspect-ratio:1; background:rgba(19,91,236,0.08); border-radius:10px; display:flex; align-items:center; justify-content:center; margin-bottom:16px;">
                    <span class="material-symbols-outlined text-primary" style="font-size:48px;">inventory_2</span>
                </div>
            @endif

            <h2 style="font-size:18px; font-weight:700; color:#f0f4ff; margin-bottom:4px;">{{ $product->name }}</h2>
            @if($product->description)
            <p style="font-size:13px; color:#8896b3; margin-bottom:16px;">{{ $product->description }}</p>
            @endif

            <div class="space-y-3 pt-4 border-t border-surface-border">
                @foreach([['Categoría', $product->category->name], ['Unidad', $product->unit->name], ['Tipo', ucfirst($product->type)], ['Proveedor', $product->supplier?->company_name ?? '—']] as [$label, $val])
                <div class="flex items-center justify-between">
                    <span style="font-size:12px; color:#8896b3;">{{ $label }}</span>
                    <span style="font-size:13px; font-weight:500; color:#f0f4ff;">{{ $val }}</span>
                </div>
                @endforeach
                <div class="flex items-center justify-between">
                    <span style="font-size:12px; color:#8896b3;">Estado</span>
                    <span class="badge" style="color:{{ $product->active ? '#10b981' : '#ef4444' }}; background:{{ $product->active ? 'rgba(16,185,129,0.12)' : 'rgba(239,68,68,0.12)' }};">{{ $product->active ? 'Activo' : 'Inactivo' }}</span>
                </div>
                <div class="flex items-center justify-between border-t border-surface-border pt-3">
                    <span style="font-size:12px; color:#8896b3;">Stock Total</span>
                    <span style="font-size:20px; font-weight:700; color:{{ $product->total_stock < 10 ? '#ef4444' : '#10b981' }};">{{ $product->total_stock }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Variants --}}
    <div class="lg:col-span-2 space-y-4">

        {{-- Add variant form --}}
        <div class="card">
            <h3 style="font-size:14px; font-weight:600; color:#f0f4ff; margin-bottom:16px; display:flex; align-items:center; gap:8px;">
                <span class="material-symbols-outlined text-primary" style="font-size:18px;">add_circle</span>
                Agregar Variante
            </h3>
            <form method="POST" action="{{ route('admin.products.variants.store', $product) }}">
                @csrf
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="form-label">Nombre *</label>
                        <input type="text" name="name" class="form-input" placeholder="Ej: Camiseta S Negro" required/>
                    </div>
                    <div>
                        <label class="form-label">SKU *</label>
                        <input type="text" name="sku" class="form-input" placeholder="CAM-S-NEG-001" required/>
                    </div>
                    <div>
                        <label class="form-label">Talla</label>
                        <input type="text" name="size" class="form-input" placeholder="S, M, L, XL"/>
                    </div>
                    <div>
                        <label class="form-label">Color</label>
                        <input type="text" name="color" class="form-input" placeholder="Negro, Blanco..."/>
                    </div>
                    <div>
                        <label class="form-label">Material</label>
                        <input type="text" name="material" class="form-input" placeholder="100% Algodón"/>
                    </div>
                    <div>
                        <label class="form-label">Tipo Sublimación</label>
                        <input type="text" name="sublimation_type" class="form-input" placeholder="DTF, Sublimación..."/>
                    </div>
                    <div>
                        <label class="form-label">Precio Costo *</label>
                        <input type="number" name="cost_price" step="0.01" class="form-input" placeholder="0.00" required/>
                    </div>
                    <div>
                        <label class="form-label">Precio Venta *</label>
                        <input type="number" name="sale_price" step="0.01" class="form-input" placeholder="0.00" required/>
                    </div>
                    <div>
                        <label class="form-label">Stock Inicial *</label>
                        <input type="number" name="stock" class="form-input" placeholder="0" min="0" required/>
                    </div>
                    <div>
                        <label class="form-label">Stock Mínimo *</label>
                        <input type="number" name="min_stock" class="form-input" placeholder="5" min="0" required/>
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="submit" class="btn-primary">
                        <span class="material-symbols-outlined" style="font-size:16px;">add</span> Agregar Variante
                    </button>
                </div>
            </form>
        </div>

        {{-- Variants list --}}
        <div class="stat-card overflow-hidden">
            <div class="px-5 py-4 border-b border-surface-border">
                <p style="font-size:14px; font-weight:600; color:#f0f4ff;">Variantes ({{ $product->variants->count() }})</p>
            </div>
            @forelse($product->variants as $variant)
            <div class="px-5 py-4 border-b border-surface-border last:border-0">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 flex-wrap">
                            <p style="font-size:14px; font-weight:600; color:#f0f4ff;">{{ $variant->name }}</p>
                            <span style="font-size:11px; color:#8896b3; font-family:'DM Mono',monospace;">{{ $variant->sku }}</span>
                            @if($variant->low_stock)
                                <span class="badge" style="color:#ef4444; background:rgba(239,68,68,0.12);">Stock Bajo</span>
                            @endif
                        </div>
                        <div class="flex items-center gap-4 mt-2 flex-wrap">
                            @if($variant->size) <span style="font-size:12px; color:#8896b3;">Talla: <strong style="color:#f0f4ff;">{{ $variant->size }}</strong></span> @endif
                            @if($variant->color) <span style="font-size:12px; color:#8896b3;">Color: <strong style="color:#f0f4ff;">{{ $variant->color }}</strong></span> @endif
                            @if($variant->material) <span style="font-size:12px; color:#8896b3;">Material: <strong style="color:#f0f4ff;">{{ $variant->material }}</strong></span> @endif
                        </div>
                    </div>
                    <div class="text-right flex-shrink-0">
                        <p style="font-size:18px; font-weight:700; color:{{ $variant->low_stock ? '#ef4444' : '#f0f4ff' }};">{{ $variant->stock }}</p>
                        <p style="font-size:11px; color:#8896b3;">unidades</p>
                        <p style="font-size:13px; font-weight:600; color:#10b981; margin-top:4px;">${{ number_format($variant->sale_price, 2) }}</p>
                        <p style="font-size:11px; color:#8896b3;">costo: ${{ number_format($variant->cost_price, 2) }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 mt-3">
                    <a href="{{ route('admin.inventory.movements', $variant) }}" style="font-size:12px; color:#135bec;">Ver movimientos</a>
                </div>
            </div>
            @empty
            <div class="text-center py-10">
                <span class="material-symbols-outlined" style="color:#4a5568; font-size:32px;">category</span>
                <p style="font-size:13px; color:#8896b3; margin-top:8px;">Sin variantes registradas</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
