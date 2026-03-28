@extends('admin.layouts.app')
@section('title', $project->title)
@section('page-title', $project->title)
@section('page-subtitle', 'Proyecto de ' . $project->customer->full_name)
@section('header-actions')
    <a href="{{ route('admin.projects.edit', $project) }}" class="btn-ghost"><span class="material-symbols-outlined" style="font-size:16px;">edit</span> Editar</a>
    <a href="{{ route('admin.projects.index') }}" class="btn-ghost"><span class="material-symbols-outlined" style="font-size:16px;">arrow_back</span> Volver</a>
@endsection
@section('content')
@php
$statusStyles = ['propuesta'=>['#f59e0b','rgba(245,158,11,0.12)'],'en_proceso'=>['#135bec','rgba(19,91,236,0.12)'],'completado'=>['#10b981','rgba(16,185,129,0.12)'],'cancelado'=>['#ef4444','rgba(239,68,68,0.12)']];
[$sc,$sb] = $statusStyles[$project->status] ?? ['#8896b3','rgba(136,150,179,0.12)'];
@endphp
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

    {{-- Main content --}}
    <div class="lg:col-span-2 space-y-5">

        {{-- Services --}}
        <div class="stat-card overflow-hidden">
            <div class="flex justify-between items-center px-5 py-4 border-b border-surface-border">
                <p style="font-size:14px; font-weight:600; color:#f0f4ff;">Servicios del Proyecto</p>
            </div>
            <table class="w-full data-table">
                <thead><tr><th class="text-left">Servicio</th><th class="text-left">Paquete</th><th class="text-right">Cant.</th><th class="text-right">Precio</th><th class="text-right">Subtotal</th><th class="text-left">Estado</th></tr></thead>
                <tbody>
                    @forelse($project->services as $ps)
                    <tr>
                        <td style="font-size:13px; font-weight:500; color:#f0f4ff;">{{ $ps->serviceVariant->service->name }}</td>
                        <td style="font-size:12px; color:#8896b3;">{{ $ps->serviceVariant->name }}</td>
                        <td style="text-align:right; font-size:13px;">{{ $ps->quantity }}</td>
                        <td style="text-align:right; font-size:13px;">${{ number_format($ps->unit_price, 2) }}</td>
                        <td style="text-align:right; font-size:14px; font-weight:700;">${{ number_format($ps->subtotal, 2) }}</td>
                        <td><span class="badge" style="color:#f59e0b; background:rgba(245,158,11,0.12);">{{ ucfirst(str_replace('_',' ',$ps->status)) }}</span></td>
                    </tr>
                    @empty
                    <tr><td colspan="6" style="text-align:center; color:#8896b3; padding:20px; font-size:13px;">Sin servicios asignados</td></tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-5 py-3 border-t border-surface-border flex justify-end">
                <p style="font-size:14px; font-weight:700; color:#10b981;">Total Servicios: ${{ number_format($project->total_cost, 2) }}</p>
            </div>
        </div>

        {{-- Add Service --}}
        <div class="card">
            <h3 style="font-size:14px; font-weight:600; color:#f0f4ff; margin-bottom:16px; display:flex; align-items:center; gap:8px;">
                <span class="material-symbols-outlined text-primary" style="font-size:18px;">add_circle</span> Agregar Servicio
            </h3>
            <form method="POST" action="{{ route('admin.projects.services.store', $project) }}">
                @csrf
                <div class="grid grid-cols-3 gap-3">
                    <div class="col-span-3 md:col-span-1">
                        <label class="form-label">Paquete de Servicio *</label>
                        <select name="service_variant_id" class="form-input" required>
                            <option value="">Seleccionar...</option>
                            @foreach($variants as $v)
                                <option value="{{ $v->id }}" data-price="{{ $v->sale_price }}">{{ $v->service->name }} — {{ $v->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Cantidad *</label>
                        <input type="number" name="quantity" class="form-input" value="1" min="1" required/>
                    </div>
                    <div>
                        <label class="form-label">Precio Unit. *</label>
                        <input type="number" name="unit_price" class="form-input" step="0.01" min="0" placeholder="0.00" required/>
                    </div>
                </div>
                <div class="flex justify-end mt-3">
                    <button type="submit" class="btn-primary"><span class="material-symbols-outlined" style="font-size:16px;">add</span> Agregar</button>
                </div>
            </form>
        </div>

        {{-- Timeline --}}
        <div class="card">
            <div class="flex justify-between items-center mb-5">
                <h3 style="font-size:14px; font-weight:600; color:#f0f4ff;">Línea de Tiempo</h3>
            </div>
            <form method="POST" action="{{ route('admin.projects.movements.store', $project) }}" class="flex flex-wrap gap-3 mb-6 pb-6 border-b border-surface-border">
                @csrf
                <select name="type" class="form-input" style="max-width:180px;" required>
                    @foreach(['inicio','progreso','entrega','cambio','pausa','completado'] as $t)
                        <option value="{{ $t }}">{{ ucfirst($t) }}</option>
                    @endforeach
                </select>
                <input type="text" name="description" class="form-input" style="flex:1; min-width:200px;" placeholder="Descripción del movimiento..." required/>
                <button type="submit" class="btn-primary"><span class="material-symbols-outlined" style="font-size:16px;">add</span> Registrar</button>
            </form>

            <div class="space-y-4">
                @forelse($project->movements as $m)
                @php
                $typeIcons = ['inicio'=>'play_circle','progreso'=>'trending_up','entrega'=>'check_circle','cambio'=>'edit','pausa'=>'pause_circle','completado'=>'task_alt'];
                $typeColors = ['inicio'=>'#135bec','progreso'=>'#8b5cf6','entrega'=>'#f59e0b','cambio'=>'#8896b3','pausa'=>'#ef4444','completado'=>'#10b981'];
                @endphp
                <div class="flex gap-4">
                    <div style="width:32px;height:32px;border-radius:50%;background:rgba(19,91,236,0.1);display:flex;align-items:center;justify-content:center;flex-shrink:0;color:{{ $typeColors[$m->type] ?? '#8896b3' }};">
                        <span class="material-symbols-outlined" style="font-size:16px;">{{ $typeIcons[$m->type] ?? 'circle' }}</span>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-2">
                            <span class="badge" style="color:{{ $typeColors[$m->type] ?? '#8896b3' }}; background:rgba(19,91,236,0.1); font-size:10px;">{{ strtoupper($m->type) }}</span>
                            <span style="font-size:11px; color:#8896b3;">{{ $m->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <p style="font-size:13px; color:#f0f4ff; margin-top:4px;">{{ $m->description }}</p>
                    </div>
                </div>
                @empty
                <p style="color:#8896b3; font-size:13px; text-align:center; padding:20px;">Sin movimientos registrados</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="space-y-4">
        <div class="card">
            <div class="flex justify-between items-center mb-4">
                <p class="form-label" style="margin-bottom:0;">Estado</p>
                <span class="badge" style="color:{{ $sc }}; background:{{ $sb }};">{{ ucfirst(str_replace('_',' ',$project->status)) }}</span>
            </div>
            <div class="space-y-3">
                <div class="flex justify-between"><span style="font-size:12px; color:#8896b3;">Cliente</span><a href="{{ route('admin.customers.show', $project->customer) }}" style="font-size:13px; color:#135bec;">{{ $project->customer->full_name }}</a></div>
                <div class="flex justify-between"><span style="font-size:12px; color:#8896b3;">Presupuesto</span><span style="font-size:14px; font-weight:700; color:#10b981;">${{ number_format($project->budget, 2) }}</span></div>
                <div class="flex justify-between"><span style="font-size:12px; color:#8896b3;">Costo Servicios</span><span style="font-size:13px; color:#f0f4ff;">${{ number_format($project->total_cost, 2) }}</span></div>
                @if($project->start_date)<div class="flex justify-between"><span style="font-size:12px; color:#8896b3;">Inicio</span><span style="font-size:12px; color:#f0f4ff;">{{ $project->start_date->format('d/m/Y') }}</span></div>@endif
                @if($project->end_date)<div class="flex justify-between"><span style="font-size:12px; color:#8896b3;">Entrega</span><span style="font-size:12px; color:#f0f4ff;">{{ $project->end_date->format('d/m/Y') }}</span></div>@endif
            </div>
        </div>

        @if($project->description)
        <div class="card">
            <p class="form-label">Descripción</p>
            <p style="font-size:13px; color:#8896b3; line-height:1.6;">{{ $project->description }}</p>
        </div>
        @endif
    </div>
</div>
@endsection
