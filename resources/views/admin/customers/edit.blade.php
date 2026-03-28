@extends('admin.layouts.app')
@section('title', 'Editar Cliente')
@section('page-title', 'Editar: ' . $customer->full_name)
@section('header-actions')
    <a href="{{ route('admin.customers.show', $customer) }}" class="btn-ghost"><span class="material-symbols-outlined" style="font-size:16px;">arrow_back</span> Volver</a>
@endsection
@section('content')
<div class="max-w-2xl">
    <div class="card">
        <form method="POST" action="{{ route('admin.customers.update', $customer) }}">
            @csrf @method('PUT')
            <div class="grid grid-cols-2 gap-5">
                <div class="col-span-2">
                    <label class="form-label">Nombre Completo *</label>
                    <input type="text" name="full_name" value="{{ old('full_name', $customer->full_name) }}" class="form-input" required/>
                </div>
                <div><label class="form-label">Teléfono *</label><input type="text" name="phone" value="{{ old('phone', $customer->phone) }}" class="form-input" required/></div>
                <div><label class="form-label">Email</label><input type="email" name="email" value="{{ old('email', $customer->email) }}" class="form-input"/></div>
                <div>
                    <label class="form-label">Tipo de Cliente</label>
                    <select name="customer_type_id" class="form-input">
                        <option value="">Sin clasificar</option>
                        @foreach($types as $t)
                            <option value="{{ $t->id }}" {{ $customer->customer_type_id == $t->id ? 'selected' : '' }}>{{ $t->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div><label class="form-label">NIT</label><input type="text" name="nit" value="{{ old('nit', $customer->nit) }}" class="form-input"/></div>
                <div><label class="form-label">Empresa</label><input type="text" name="company_name" value="{{ old('company_name', $customer->company_name) }}" class="form-input"/></div>
                <div><label class="form-label">Persona de Contacto</label><input type="text" name="contact_person" value="{{ old('contact_person', $customer->contact_person) }}" class="form-input"/></div>
                <div><label class="form-label">Límite Crédito ($)</label><input type="number" name="credit_limit" value="{{ old('credit_limit', $customer->credit_limit) }}" class="form-input" step="0.01" min="0"/></div>
                <div class="col-span-2"><label class="form-label">Dirección</label><textarea name="address" class="form-input" rows="2">{{ old('address', $customer->address) }}</textarea></div>
                <div class="col-span-2 flex items-center gap-3 py-3 border-t border-surface-border">
                    <input type="hidden" name="active" value="0"/>
                    <input type="checkbox" name="active" value="1" id="active" {{ $customer->active ? 'checked' : '' }} style="accent-color:#135bec; width:16px; height:16px;"/>
                    <label for="active" style="font-size:14px; color:#f0f4ff; cursor:pointer;">Cliente activo</label>
                </div>
                <div class="col-span-2 flex justify-end gap-3 pt-2 border-t border-surface-border">
                    <a href="{{ route('admin.customers.show', $customer) }}" class="btn-ghost">Cancelar</a>
                    <button type="submit" class="btn-primary"><span class="material-symbols-outlined" style="font-size:16px;">save</span> Guardar Cambios</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
