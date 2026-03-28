@extends('admin.layouts.app')
@section('title', 'Editar Proyecto')
@section('page-title', 'Editar: ' . $project->title)
@section('header-actions')
    <a href="{{ route('admin.projects.show', $project) }}" class="btn-ghost"><span class="material-symbols-outlined" style="font-size:16px;">arrow_back</span> Volver</a>
@endsection
@section('content')
<div class="max-w-2xl">
    <div class="card">
        <form method="POST" action="{{ route('admin.projects.update', $project) }}">
            @csrf @method('PUT')
            <div class="grid grid-cols-2 gap-5">
                <div class="col-span-2">
                    <label class="form-label">Título *</label>
                    <input type="text" name="title" value="{{ old('title', $project->title) }}" class="form-input" required/>
                </div>
                <div>
                    <label class="form-label">Estado *</label>
                    <select name="status" class="form-input" required>
                        @foreach(['propuesta','en_proceso','completado','cancelado'] as $s)
                            <option value="{{ $s }}" {{ $project->status === $s ? 'selected' : '' }}>{{ ucfirst(str_replace('_',' ',$s)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label">Presupuesto ($)</label>
                    <input type="number" name="budget" value="{{ old('budget', $project->budget) }}" class="form-input" step="0.01" min="0"/>
                </div>
                <div>
                    <label class="form-label">Fecha de Inicio</label>
                    <input type="date" name="start_date" value="{{ old('start_date', $project->start_date?->format('Y-m-d')) }}" class="form-input"/>
                </div>
                <div>
                    <label class="form-label">Fecha de Entrega</label>
                    <input type="date" name="end_date" value="{{ old('end_date', $project->end_date?->format('Y-m-d')) }}" class="form-input"/>
                </div>
                <div class="col-span-2">
                    <label class="form-label">Descripción</label>
                    <textarea name="description" class="form-input" rows="4">{{ old('description', $project->description) }}</textarea>
                </div>
                <div class="col-span-2 flex justify-end gap-3 pt-2 border-t border-surface-border">
                    <a href="{{ route('admin.projects.show', $project) }}" class="btn-ghost">Cancelar</a>
                    <button type="submit" class="btn-primary"><span class="material-symbols-outlined" style="font-size:16px;">save</span> Guardar Cambios</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
