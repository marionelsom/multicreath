@extends('admin.layouts.app')
@section('title', 'Editar Proveedor')
@section('page-title', 'Editar: ' . $supplier->company_name)
@section('page-subtitle', 'Modificar información del proveedor')

@section('header-actions')
    <a href="{{ route('admin.suppliers.index') }}" class="btn-ghost">
        <span class="material-symbols-outlined" style="font-size:16px;">arrow_back</span> Volver
    </a>
@endsection

@section('content')
<div class="max-w-2xl">
    <div class="card">
        <form method="POST" action="{{ route('admin.suppliers.update', $supplier) }}">
            @csrf @method('PUT')
            <div class="grid grid-cols-2 gap-5">
                <div class="col-span-2">
                    <label class="form-label">Nombre de la Empresa *</label>
                    <input type="text" name="company_name" value="{{ old('company_name', $supplier->company_name) }}" class="form-input" required/>
                </div>
                <div>
                    <label class="form-label">Persona de Contacto</label>
                    <input type="text" name="contact_person" value="{{ old('contact_person', $supplier->contact_person) }}" class="form-input"/>
                </div>
                <div>
                    <label class="form-label">Teléfono *</label>
                    <input type="text" name="phone" value="{{ old('phone', $supplier->phone) }}" class="form-input" required/>
                </div>
                <div>
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email', $supplier->email) }}" class="form-input"/>
                </div>
                <div>
                    <label class="form-label">Categoría de Productos</label>
                    <input type="text" name="product_category" value="{{ old('product_category', $supplier->product_category) }}" class="form-input"/>
                </div>
                <div class="col-span-2">
                    <label class="form-label">Dirección</label>
                    <textarea name="address" class="form-input" rows="2">{{ old('address', $supplier->address) }}</textarea>
                </div>
                <div class="col-span-2 flex justify-between items-center pt-2 border-t border-surface-border">
                    <form method="POST" action="{{ route('admin.suppliers.destroy', $supplier) }}"
                          onsubmit="return confirm('¿Eliminar permanentemente este proveedor?')">
                        @csrf @method('DELETE')
                        <button type="submit" style="font-size:13px; color:#ef4444; background:transparent; border:none; cursor:pointer; display:flex; align-items:center; gap:6px;">
                            <span class="material-symbols-outlined" style="font-size:16px;">delete</span> Eliminar
                        </button>
                    </form>
                    <div class="flex gap-3">
                        <a href="{{ route('admin.suppliers.index') }}" class="btn-ghost">Cancelar</a>
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
