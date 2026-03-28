@extends('admin.layouts.app')
@section('title', 'Productos')
@section('page-title', 'Productos')
@section('page-subtitle', 'Catálogo de productos de la tienda')

@section('header-actions')
    <a href="{{ route('admin.products.create') }}" class="btn-primary">
        <span class="material-symbols-outlined" style="font-size:16px;">add</span> Nuevo Producto
    </a>
@endsection

@section('content')
{{-- Filters --}}
<div class="card mb-4">
    <form method="GET" class="flex flex-wrap gap-3">
        <input type="text" name="search" value="{{ request('search') }}" class="form-input" style="max-width:280px;" placeholder="Buscar productos..."/>
        <select name="category" class="form-input" style="max-width:200px;">
            <option value="">Todas las categorías</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn-primary">
            <span class="material-symbols-outlined" style="font-size:16px;">search</span> Filtrar
        </button>
        @if(request('search') || request('category'))
            <a href="{{ route('admin.products.index') }}" class="btn-ghost">Limpiar</a>
        @endif
    </form>
</div>

{{-- Table --}}
<div class="stat-card overflow-hidden">
    <table class="w-full data-table">
        <thead>
            <tr>
                <th class="text-left">Producto</th>
                <th class="text-left">Categoría</th>
                <th class="text-left">Tipo</th>
                <th class="text-left">Variantes</th>
                <th class="text-left">Stock Total</th>
                <th class="text-left">Estado</th>
                <th class="text-left">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td>
                    <div class="flex items-center gap-3">
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}" class="w-9 h-9 rounded-lg object-cover flex-shrink-0" alt="{{ $product->name }}"/>
                        @else
                            <div style="width:36px;height:36px;border-radius:8px;background:rgba(19,91,236,0.1);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <span class="material-symbols-outlined text-primary" style="font-size:18px;">inventory_2</span>
                            </div>
                        @endif
                        <div>
                            <a href="{{ route('admin.products.show', $product) }}" style="font-size:14px; font-weight:500; color:#f0f4ff;">{{ $product->name }}</a>
                            @if($product->description)
                            <p style="font-size:12px; color:#8896b3;" class="truncate" style="max-width:200px;">{{ Str::limit($product->description, 50) }}</p>
                            @endif
                        </div>
                    </div>
                </td>
                <td style="font-size:13px; color:#8896b3;">{{ $product->category->name }}</td>
                <td>
                    <span class="badge" style="color:{{ $product->type === 'blanco' ? '#8896b3' : '#135bec' }}; background:{{ $product->type === 'blanco' ? 'rgba(136,150,179,0.12)' : 'rgba(19,91,236,0.12)' }};">
                        {{ ucfirst($product->type) }}
                    </span>
                </td>
                <td style="font-size:14px; font-weight:600; color:#f0f4ff;">{{ $product->variants->count() }}</td>
                <td style="font-size:14px; font-weight:600; color:{{ $product->total_stock < 10 ? '#ef4444' : '#f0f4ff' }};">
                    {{ $product->total_stock }}
                </td>
                <td>
                    <span class="badge" style="color:{{ $product->active ? '#10b981' : '#ef4444' }}; background:{{ $product->active ? 'rgba(16,185,129,0.12)' : 'rgba(239,68,68,0.12)' }};">
                        {{ $product->active ? 'Activo' : 'Inactivo' }}
                    </span>
                </td>
                <td>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.products.show', $product) }}" style="color:#8896b3; transition:color 0.15s;" onmouseover="this.style.color='#f0f4ff'" onmouseout="this.style.color='#8896b3'">
                            <span class="material-symbols-outlined" style="font-size:18px;">visibility</span>
                        </a>
                        <a href="{{ route('admin.products.edit', $product) }}" style="color:#8896b3; transition:color 0.15s;" onmouseover="this.style.color='#135bec'" onmouseout="this.style.color='#8896b3'">
                            <span class="material-symbols-outlined" style="font-size:18px;">edit</span>
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center py-12">
                    <span class="material-symbols-outlined" style="font-size:40px; color:#4a5568;">inventory_2</span>
                    <p style="color:#8896b3; margin-top:8px;">No hay productos registrados</p>
                    <a href="{{ route('admin.products.create') }}" class="btn-primary" style="margin-top:12px; display:inline-flex;">Crear primer producto</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($products->hasPages())
    <div class="px-5 py-4 border-t border-surface-border">
        {{ $products->withQueryString()->links() }}
    </div>
    @endif
</div>
@endsection
