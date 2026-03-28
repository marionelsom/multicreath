@extends('admin.layouts.app')
@section('title', 'Proyectos')
@section('page-title', 'Proyectos')
@section('page-subtitle', 'Gestión de proyectos de agencia')
@section('header-actions')
    <a href="{{ route('admin.projects.create') }}" class="btn-primary"><span class="material-symbols-outlined" style="font-size:16px;">add</span> Nuevo Proyecto</a>
@endsection
@section('content')
<div class="card mb-4">
    <form method="GET" class="flex flex-wrap gap-3">
        <input type="text" name="search" value="{{ request('search') }}" class="form-input" style="max-width:280px;" placeholder="Buscar proyectos..."/>
        <select name="status" class="form-input" style="max-width:180px;">
            <option value="">Todos los estados</option>
            @foreach(['propuesta','en_proceso','completado','cancelado'] as $s)
                <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst(str_replace('_',' ',$s)) }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn-primary"><span class="material-symbols-outlined" style="font-size:16px;">search</span> Filtrar</button>
        @if(request('search') || request('status'))<a href="{{ route('admin.projects.index') }}" class="btn-ghost">Limpiar</a>@endif
    </form>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse($projects as $project)
    @php
    $statusStyles = ['propuesta'=>['#f59e0b','rgba(245,158,11,0.12)'],'en_proceso'=>['#135bec','rgba(19,91,236,0.12)'],'completado'=>['#10b981','rgba(16,185,129,0.12)'],'cancelado'=>['#ef4444','rgba(239,68,68,0.12)']];
    [$sc,$sb] = $statusStyles[$project->status] ?? ['#8896b3','rgba(136,150,179,0.12)'];
    @endphp
    <a href="{{ route('admin.projects.show', $project) }}" class="stat-card p-5 block hover:border-primary/30 transition-colors" style="text-decoration:none;">
        <div class="flex items-start justify-between mb-3">
            <div style="width:40px;height:40px;border-radius:10px;background:rgba(19,91,236,0.1);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <span class="material-symbols-outlined text-primary" style="font-size:20px;">folder_open</span>
            </div>
            <span class="badge" style="color:{{ $sc }}; background:{{ $sb }};">{{ ucfirst(str_replace('_',' ',$project->status)) }}</span>
        </div>
        <h3 style="font-size:15px; font-weight:700; color:#f0f4ff; margin-bottom:4px;">{{ $project->title }}</h3>
        <p style="font-size:13px; color:#8896b3; margin-bottom:12px;">{{ $project->customer->full_name }}</p>
        @if($project->description)
        <p style="font-size:12px; color:#8896b3; margin-bottom:12px;">{{ Str::limit($project->description, 80) }}</p>
        @endif
        <div class="flex items-center justify-between pt-3 border-t border-surface-border">
            <span style="font-size:12px; color:#8896b3;">Presupuesto</span>
            <span style="font-size:14px; font-weight:700; color:#10b981;">${{ number_format($project->budget, 2) }}</span>
        </div>
        @if($project->start_date)
        <div class="flex items-center justify-between mt-2">
            <span style="font-size:12px; color:#8896b3;">Inicio</span>
            <span style="font-size:12px; color:#f0f4ff;">{{ $project->start_date->format('d/m/Y') }}</span>
        </div>
        @endif
    </a>
    @empty
    <div class="col-span-3 text-center py-16">
        <span class="material-symbols-outlined" style="font-size:48px; color:#4a5568;">folder_open</span>
        <p style="color:#8896b3; margin-top:8px;">No hay proyectos registrados</p>
        <a href="{{ route('admin.projects.create') }}" class="btn-primary" style="margin-top:12px; display:inline-flex;">Crear primer proyecto</a>
    </div>
    @endforelse
</div>

@if($projects->hasPages())
<div class="mt-4">{{ $projects->withQueryString()->links() }}</div>
@endif
@endsection
