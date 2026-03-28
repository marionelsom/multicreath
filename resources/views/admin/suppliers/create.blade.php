@extends('admin.layouts.app')
@section('title', 'Nuevo Proveedor')
@section('page-title', 'Nuevo Proveedor')
@section('page-subtitle', 'Registrar un nuevo proveedor de insumos')

@section('header-actions')
    <a href="{{ route('admin.suppliers.index') }}" class="btn-ghost">
        <span class="material-symbols-outlined" style="font-size:16px;">arrow_back</span> Volver
    </a>
@endsection

@section('content')
<div class="max-w-2xl">
    <div class="card">
        <form method="POST" action="{{ route('admin.suppliers.store') }}">
            @csrf
            <div class="grid grid-cols-2 gap-5">
                <div class="col-span-2">
                    <label class="form-label">Nombre de la Empresa *</label>
                    <input type="text" name="company_name" value="{{ old('company_name') }}" class="form-input" placeholder="Ej: Distribuidora Textil S.A." required/>
                </div>
                <div>
                    <label class="form-label">Persona de Contacto</label>
                    <input type="text" name="contact_person" value="{{ old('contact_person') }}" class="form-input" placeholder="Nombre del representante"/>
                </div>
                <div>
                    <label class="form-label">Teléfono *</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-input" placeholder="+503 7777-7777" required/>
                </div>
                <div>
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-input" placeholder="proveedor@empresa.com"/>
                </div>
                <div>
                    <label class="form-label">Categoría de Productos</label>
                    <input type="text" name="product_category" value="{{ old('product_category') }}" class="form-input" placeholder="Ej: Textiles, Insumos DTF..."/>
                </div>
                <div class="col-span-2">
                    <label class="form-label">Dirección</label>
                    <textarea name="address" class="form-input" rows="2" placeholder="Dirección completa del proveedor">{{ old('address') }}</textarea>
                </div>
                <div class="col-span-2 flex justify-end gap-3 pt-2 border-t border-surface-border">
                    <a href="{{ route('admin.suppliers.index') }}" class="btn-ghost">Cancelar</a>
                    <button type="submit" class="btn-primary">
                        <span class="material-symbols-outlined" style="font-size:16px;">save</span> Guardar Proveedor
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
