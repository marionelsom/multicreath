@extends('admin.layouts.app')
@section('title', 'Nuevo Producto')
@section('page-title', 'Nuevo Producto')
@section('page-subtitle', 'Registrar un producto en el catálogo')

@section('header-actions')
    <a href="{{ route('admin.products.index') }}" class="btn-ghost">
        <span class="material-symbols-outlined" style="font-size:16px;">arrow_back</span> Volver
    </a>
@endsection

@section('content')
<div class="max-w-2xl">
    <div class="card">
        <form method="POST" action="{{ route('admin.products.store') }}">
            @csrf
            <div class="grid grid-cols-1 gap-5">

                <div>
                    <label class="form-label">Nombre del Producto *</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-input" placeholder="Ej: Camiseta 100% Algodón" required/>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Categoría *</label>
                        <select name="category_id" class="form-input" required>
                            <option value="">Seleccionar...</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Unidad de Medida *</label>
                        <select name="unit_id" class="form-input" required>
                            <option value="">Seleccionar...</option>
                            @foreach($units as $unit)
                                <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : '' }}>{{ $unit->name }} ({{ $unit->symbol }})</option>
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
                                <option value="{{ $s->id }}" {{ old('supplier_id') == $s->id ? 'selected' : '' }}>{{ $s->company_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Tipo *</label>
                        <select name="type" class="form-input" required>
                            <option value="personalizacion" {{ old('type') === 'personalizacion' ? 'selected' : '' }}>Personalización</option>
                            <option value="blanco" {{ old('type') === 'blanco' ? 'selected' : '' }}>Blanco (sin diseño)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="form-label">URL de Imagen</label>
                    <input type="url" name="image_url" value="{{ old('image_url') }}" class="form-input" placeholder="https://..."/>
                </div>

                <div>
                    <label class="form-label">Descripción</label>
                    <textarea name="description" class="form-input" rows="3" placeholder="Descripción del producto...">{{ old('description') }}</textarea>
                </div>

                <div class="flex justify-end gap-3 pt-2 border-t border-surface-border">
                    <a href="{{ route('admin.products.index') }}" class="btn-ghost">Cancelar</a>
                    <button type="submit" class="btn-primary">
                        <span class="material-symbols-outlined" style="font-size:16px;">save</span> Guardar Producto
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
