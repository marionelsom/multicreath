@extends('admin.layouts.app')
@section('title', 'Nuevo Proyecto')
@section('page-title', 'Nuevo Proyecto')
@section('header-actions')
    <a href="{{ route('admin.projects.index') }}" class="btn-ghost"><span class="material-symbols-outlined" style="font-size:16px;">arrow_back</span> Volver</a>
@endsection
@section('content')
<div class="max-w-2xl">
    <div class="card">
        <form method="POST" action="{{ route('admin.projects.store') }}">
            @csrf
            <div class="grid grid-cols-2 gap-5">
                <div class="col-span-2">
                    <label class="form-label">Cliente *</label>
                    <select name="customer_id" class="form-input" required>
                        <option value="">Seleccionar cliente...</option>
                        @foreach($customers as $c)
                            <option value="{{ $c->id }}">{{ $c->full_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2">
                    <label class="form-label">Título del Proyecto *</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="form-input" placeholder="Ej: Diseño Web Corporativo" required/>
                </div>
                <div>
                    <label class="form-label">Fecha de Inicio</label>
                    <input type="date" name="start_date" value="{{ old('start_date') }}" class="form-input"/>
                </div>
                <div>
                    <label class="form-label">Fecha de Entrega</label>
                    <input type="date" name="end_date" value="{{ old('end_date') }}" class="form-input"/>
                </div>
                <div class="col-span-2">
                    <label class="form-label">Presupuesto ($)</label>
                    <input type="number" name="budget" value="{{ old('budget', 0) }}" class="form-input" step="0.01" min="0"/>
                </div>
                <div class="col-span-2">
                    <label class="form-label">Descripción</label>
                    <textarea name="description" class="form-input" rows="4" placeholder="Descripción detallada del proyecto...">{{ old('description') }}</textarea>
                </div>
                <div class="col-span-2 flex justify-end gap-3 pt-2 border-t border-surface-border">
                    <a href="{{ route('admin.projects.index') }}" class="btn-ghost">Cancelar</a>
                    <button type="submit" class="btn-primary"><span class="material-symbols-outlined" style="font-size:16px;">save</span> Crear Proyecto</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
