@extends('admin.layouts.app')
@section('title', 'Nuevo Cliente')
@section('page-title', 'Nuevo Cliente')
@section('header-actions')
    <a href="{{ route('admin.customers.index') }}" class="btn-ghost"><span class="material-symbols-outlined" style="font-size:16px;">arrow_back</span> Volver</a>
@endsection
@section('content')
<div class="max-w-2xl">
    <div class="card">
        <form method="POST" action="{{ route('admin.customers.store') }}">
            @csrf
            <div class="grid grid-cols-1 gap-5">
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <label class="form-label">Nombre Completo *</label>
                        <input type="text" name="full_name" value="{{ old('full_name') }}" class="form-input" required/>
                    </div>
                    <div>
                        <label class="form-label">Teléfono *</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-input" placeholder="+503 7777-7777" required/>
                    </div>
                    <div>
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-input" placeholder="cliente@email.com"/>
                    </div>
                    <div>
                        <label class="form-label">Tipo de Cliente</label>
                        <select name="customer_type_id" class="form-input">
                            <option value="">Sin clasificar</option>
                            @foreach($types as $t)
                                <option value="{{ $t->id }}">{{ $t->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label">NIT</label>
                        <input type="text" name="nit" value="{{ old('nit') }}" class="form-input" placeholder="Para facturación"/>
                    </div>
                    <div>
                        <label class="form-label">Empresa</label>
                        <input type="text" name="company_name" value="{{ old('company_name') }}" class="form-input"/>
                    </div>
                    <div>
                        <label class="form-label">Persona de Contacto</label>
                        <input type="text" name="contact_person" value="{{ old('contact_person') }}" class="form-input"/>
                    </div>
                    <div>
                        <label class="form-label">Límite de Crédito ($)</label>
                        <input type="number" name="credit_limit" value="{{ old('credit_limit') }}" class="form-input" step="0.01" min="0" placeholder="0.00"/>
                    </div>
                    <div class="col-span-2">
                        <label class="form-label">Dirección</label>
                        <textarea name="address" class="form-input" rows="2">{{ old('address') }}</textarea>
                    </div>
                </div>
                <div class="flex justify-end gap-3 pt-2 border-t border-surface-border">
                    <a href="{{ route('admin.customers.index') }}" class="btn-ghost">Cancelar</a>
                    <button type="submit" class="btn-primary"><span class="material-symbols-outlined" style="font-size:16px;">save</span> Guardar Cliente</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
