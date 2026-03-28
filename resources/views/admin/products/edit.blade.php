@extends('admin.layouts.app')
@section('title', 'Editar Producto')
@section('page-title', 'Editar: ' . $product->name)
@section('page-subtitle', 'Modificar información del producto')

@section('header-actions')
    <a href="{{ route('admin.products.show', $product) }}" class="btn-ghost">
        <span class="material-symbols-outlined" style="font-size:16px;">arrow_back</span> Volver
    </a>
@endsection

@section('content')
<div class="max-w-2xl">
    <div class="card">
        <form method="POST" action="{{ route('admin.products.update', $product) }}">
            @csrf @method('PUT')
            <div class="grid grid-cols-1 gap-5">
                <div>
                    <label class="form-label">Nombre *</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-input" required/>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Categoría *</label>
                        <select name="category_id" class="form-input" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Unidad *</label>
                        <select name="unit_id" class="form-input" required>
                            @foreach($units as $unit)
                                <option value="{{ $unit->id }}" {{ $product->unit_id == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Proveedor</label>
                        <select name="supplier_id" class="form-input">
                            <option value="">Sin proveedor</option>
                            @foreach($suppliers as $s)
                                <option value="{{ $s->id }}" {{ $product->supplier_id == $s->id ? 'selected' : '' }}>{{ $s->company_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Tipo *</label>
                        <select name="type" class="form-input" required>
                            <option value="personalizacion" {{ $product->type === 'personalizacion' ? 'selected' : '' }}>Personalización</option>
                            <option value="blanco" {{ $product->type === 'blanco' ? 'selected' : '' }}>Blanco</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="form-label">URL de Imagen</label>
                    <input type="url" name="image_url" value="{{ old('image_url', $product->image_url) }}" class="form-input"/>
                </div>
                <div>
                    <label class="form-label">Descripción</label>
                    <textarea name="description" class="form-input" rows="3">{{ old('description', $product->description) }}</textarea>
                </div>
                <div class="flex items-center gap-3 py-3 border-t border-surface-border">
                    <input type="hidden" name="active" value="0"/>
                    <input type="checkbox" name="active" value="1" id="active" {{ $product->active ? 'checked' : '' }} style="accent-color:#135bec; width:16px; height:16px;"/>
                    <label for="active" style="font-size:14px; color:#f0f4ff; cursor:pointer;">Producto activo</label>
                </div>
                <div class="flex justify-between items-center pt-2 border-t border-surface-border">
                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('¿Desactivar este producto?')">
                        @csrf @method('DELETE')
                        <button type="submit" style="font-size:13px; color:#ef4444; background:transparent; border:none; cursor:pointer; display:flex; align-items:center; gap:6px;">
                            <span class="material-symbols-outlined" style="font-size:16px;">block</span> Desactivar
                        </button>
                    </form>
                    <div class="flex gap-3">
                        <a href="{{ route('admin.products.show', $product) }}" class="btn-ghost">Cancelar</a>
                        <button type="submit" class="btn-primary">
                            <span class="material-symbols-outlined" style="font-size:16px;">save</span> Guardar Cambios
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
