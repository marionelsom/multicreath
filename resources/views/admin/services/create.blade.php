@extends('admin.layouts.app')
@section('title', 'Nuevo Servicio')
@section('page-title', 'Nuevo Servicio')
@section('page-subtitle', 'Registrar un servicio de agencia')

@section('header-actions')
    <a href="{{ route('admin.services.index') }}" class="btn-ghost">
        <span class="material-symbols-outlined" style="font-size:16px;">arrow_back</span> Volver
    </a>
@endsection

@section('content')
<div class="max-w-2xl">
    <div class="card">
        <form method="POST" action="{{ route('admin.services.store') }}">
            @csrf
            <div class="grid grid-cols-2 gap-5">
                <div class="col-span-2">
                    <label class="form-label">Nombre del Servicio *</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-input" placeholder="Ej: Diseño Web Responsivo" required/>
                </div>
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
                <div class="col-span-2">
                    <label class="form-label">Descripción</label>
                    <textarea name="description" class="form-input" rows="3" placeholder="Descripción del servicio...">{{ old('description') }}</textarea>
                </div>
                <div class="col-span-2 flex justify-end gap-3 pt-2 border-t border-surface-border">
                    <a href="{{ route('admin.services.index') }}" class="btn-ghost">Cancelar</a>
                    <button type="submit" class="btn-primary">
                        <span class="material-symbols-outlined" style="font-size:16px;">save</span> Guardar Servicio
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
