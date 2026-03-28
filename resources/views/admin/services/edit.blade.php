@extends('admin.layouts.app')
@section('title', 'Editar Servicio')
@section('page-title', 'Editar: ' . $service->name)
@section('page-subtitle', 'Modificar información del servicio')

@section('header-actions')
    <a href="{{ route('admin.services.show', $service) }}" class="btn-ghost">
        <span class="material-symbols-outlined" style="font-size:16px;">arrow_back</span> Volver
    </a>
@endsection

@section('content')
<div class="max-w-2xl">
    <div class="card">
        <form method="POST" action="{{ route('admin.services.update', $service) }}">
            @csrf @method('PUT')
            <div class="grid grid-cols-2 gap-5">
                <div class="col-span-2">
                    <label class="form-label">Nombre *</label>
                    <input type="text" name="name" value="{{ old('name', $service->name) }}" class="form-input" required/>
                </div>
                <div>
                    <label class="form-label">Categoría *</label>
                    <select name="category_id" class="form-input" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $service->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label">Unidad *</label>
                    <select name="unit_id" class="form-input" required>
                        @foreach($units as $unit)
                            <option value="{{ $unit->id }}" {{ $service->unit_id == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2">
                    <label class="form-label">Descripción</label>
                    <textarea name="description" class="form-input" rows="3">{{ old('description', $service->description) }}</textarea>
                </div>
                <div class="col-span-2 flex items-center gap-3 py-3 border-t border-surface-border">
                    <input type="hidden" name="active" value="0"/>
                    <input type="checkbox" name="active" value="1" id="active" {{ $service->active ? 'checked' : '' }} style="accent-color:#135bec; width:16px; height:16px;"/>
                    <label for="active" style="font-size:14px; color:#f0f4ff; cursor:pointer;">Servicio activo</label>
                </div>
                <div class="col-span-2 flex justify-end gap-3 pt-2 border-t border-surface-border">
                    <a href="{{ route('admin.services.show', $service) }}" class="btn-ghost">Cancelar</a>
                    <button type="submit" class="btn-primary">
                        <span class="material-symbols-outlined" style="font-size:16px;">save</span> Guardar Cambios
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
