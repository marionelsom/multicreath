@extends('admin.layouts.app')
@section('title', 'Proveedores')
@section('page-title', 'Proveedores')
@section('page-subtitle', 'Gestión de proveedores de insumos')

@section('header-actions')
    <a href="{{ route('admin.suppliers.create') }}" class="btn-primary">
        <span class="material-symbols-outlined" style="font-size:16px;">add</span> Nuevo Proveedor
    </a>
@endsection

@section('content')
<div class="card mb-4">
    <form method="GET" class="flex flex-wrap gap-3">
        <input type="text" name="search" value="{{ request('search') }}" class="form-input" style="max-width:320px;" placeholder="Buscar por empresa o email..."/>
        <button type="submit" class="btn-primary"><span class="material-symbols-outlined" style="font-size:16px;">search</span> Buscar</button>
        @if(request('search'))<a href="{{ route('admin.suppliers.index') }}" class="btn-ghost">Limpiar</a>@endif
    </form>
</div>

<div class="stat-card overflow-hidden">
    <table class="w-full data-table">
        <thead>
            <tr>
                <th class="text-left">Empresa</th>
                <th class="text-left">Contacto</th>
                <th class="text-left">Teléfono</th>
                <th class="text-left">Categoría</th>
                <th class="text-left">Productos</th>
                <th class="text-left">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($suppliers as $supplier)
            <tr>
                <td>
                    <div class="flex items-center gap-3">
                        <div style="width:36px;height:36px;border-radius:8px;background:rgba(139,92,246,0.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <span class="material-symbols-outlined" style="color:#8b5cf6; font-size:18px;">local_shipping</span>
                        </div>
                        <div>
                            <p style="font-size:14px; font-weight:500; color:#f0f4ff;">{{ $supplier->company_name }}</p>
                            @if($supplier->email)<p style="font-size:12px; color:#8896b3;">{{ $supplier->email }}</p>@endif
                        </div>
                    </div>
                </td>
                <td style="font-size:13px; color:#8896b3;">{{ $supplier->contact_person ?? '—' }}</td>
                <td style="font-size:13px; color:#f0f4ff;">{{ $supplier->phone }}</td>
                <td>
                    @if($supplier->product_category)
                        <span class="badge" style="color:#8b5cf6; background:rgba(139,92,246,0.12);">{{ $supplier->product_category }}</span>
                    @else
                        <span style="color:#4a5568; font-size:13px;">—</span>
                    @endif
                </td>
                <td style="font-size:14px; font-weight:600; color:#f0f4ff;">{{ $supplier->products_count }}</td>
                <td>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.suppliers.edit', $supplier) }}"
                           style="color:#8896b3; transition:color 0.15s;"
                           onmouseover="this.style.color='#135bec'" onmouseout="this.style.color='#8896b3'">
                            <span class="material-symbols-outlined" style="font-size:18px;">edit</span>
                        </a>
                        <form method="POST" action="{{ route('admin.suppliers.destroy', $supplier) }}"
                              onsubmit="return confirm('¿Eliminar proveedor {{ addslashes($supplier->company_name) }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" style="background:none;border:none;cursor:pointer;color:#8896b3;padding:0;transition:color 0.15s;"
                                    onmouseover="this.style.color='#ef4444'" onmouseout="this.style.color='#8896b3'">
                                <span class="material-symbols-outlined" style="font-size:18px;">delete</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-12">
                    <span class="material-symbols-outlined" style="font-size:40px; color:#4a5568;">local_shipping</span>
                    <p style="color:#8896b3; margin-top:8px;">No hay proveedores registrados</p>
                    <a href="{{ route('admin.suppliers.create') }}" class="btn-primary" style="margin-top:12px; display:inline-flex;">Agregar proveedor</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($suppliers->hasPages())
    <div class="px-5 py-4 border-t border-surface-border">{{ $suppliers->withQueryString()->links() }}</div>
    @endif
</div>
@endsection
