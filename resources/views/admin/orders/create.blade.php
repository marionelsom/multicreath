@extends('admin.layouts.app')
@section('title', 'Nueva Orden')
@section('page-title', 'Nueva Orden')
@section('header-actions')
    <a href="{{ route('admin.orders.index') }}" class="btn-ghost"><span class="material-symbols-outlined" style="font-size:16px;">arrow_back</span> Volver</a>
@endsection
@section('content')
<div class="max-w-3xl">
    <div class="card">
        <form method="POST" action="{{ route('admin.orders.store') }}" id="orderForm">
            @csrf
            <div class="grid grid-cols-1 gap-5">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Cliente *</label>
                        <select name="customer_id" class="form-input" required>
                            <option value="">Seleccionar cliente...</option>
                            @foreach($customers as $c)
                                <option value="{{ $c->id }}">{{ $c->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Método de Pago</label>
                        <select name="payment_method" class="form-input">
                            <option value="">Sin especificar</option>
                            <option value="efectivo">Efectivo</option>
                            <option value="tarjeta">Tarjeta</option>
                            <option value="transferencia">Transferencia</option>
                        </select>
                    </div>
                </div>

                {{-- Items --}}
                <div>
                    <div class="flex justify-between items-center mb-3">
                        <label class="form-label" style="margin-bottom:0;">Productos *</label>
                        <button type="button" onclick="addItem()" class="btn-primary" style="padding:6px 12px; font-size:12px;">
                            <span class="material-symbols-outlined" style="font-size:14px;">add</span> Agregar
                        </button>
                    </div>

                    <div id="itemsContainer" class="space-y-3">
                        <div class="item-row" style="background:#1e2535; border-radius:8px; padding:12px; display:grid; grid-template-columns:1fr 80px 120px 36px; gap:8px; align-items:end;">
                            <div>
                                <label class="form-label">Variante</label>
                                <select name="items[0][variant_id]" class="form-input variant-select" onchange="updatePrice(this)" required>
                                    <option value="">Seleccionar...</option>
                                    @foreach($variants as $v)
                                        <option value="{{ $v->id }}" data-price="{{ $v->sale_price }}">{{ $v->product->name }} — {{ $v->name }} (${{ number_format($v->sale_price,2) }}) [{{ $v->stock }} uds]</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="form-label">Cantidad</label>
                                <input type="number" name="items[0][quantity]" class="form-input quantity-input" min="1" value="1" onchange="calcTotal()" required/>
                            </div>
                            <div>
                                <label class="form-label">Precio Unit.</label>
                                <input type="number" name="items[0][price]" class="form-input price-input" step="0.01" min="0" value="0" onchange="calcTotal()" required/>
                            </div>
                            <div style="padding-bottom:2px;">
                                <button type="button" onclick="removeItem(this)" style="width:34px;height:34px;background:rgba(239,68,68,0.12);border:none;border-radius:6px;cursor:pointer;color:#ef4444;display:flex;align-items:center;justify-content:center;">
                                    <span class="material-symbols-outlined" style="font-size:16px;">delete</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top:16px; padding:16px; background:#1e2535; border-radius:8px; display:flex; justify-content:space-between; align-items:center;">
                        <div>
                            <p style="font-size:12px; color:#8896b3;">Subtotal: <span id="subtotalDisplay">$0.00</span></p>
                            <p style="font-size:12px; color:#8896b3;">IVA 13%: <span id="taxDisplay">$0.00</span></p>
                        </div>
                        <p style="font-size:20px; font-weight:700; color:#10b981;">Total: <span id="totalDisplay">$0.00</span></p>
                    </div>
                </div>

                <div>
                    <label class="form-label">Notas</label>
                    <textarea name="notes" class="form-input" rows="2" placeholder="Instrucciones especiales, personalización..."></textarea>
                </div>

                <div class="flex justify-end gap-3 pt-2 border-t border-surface-border">
                    <a href="{{ route('admin.orders.index') }}" class="btn-ghost">Cancelar</a>
                    <button type="submit" class="btn-primary"><span class="material-symbols-outlined" style="font-size:16px;">save</span> Crear Orden</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
const variantsData = @json($variants->keyBy('id')->map(fn($v) => ['price' => $v->sale_price]));
let itemCount = 1;

function addItem() {
    const i = itemCount++;
    const variantOptions = `<option value="">Seleccionar...</option>` +
        @foreach($variants as $v)
        `<option value="{{ $v->id }}" data-price="{{ $v->sale_price }}">{{ addslashes($v->product->name) }} — {{ addslashes($v->name) }} (${{ number_format($v->sale_price,2) }}) [{{ $v->stock }} uds]</option>` +
        @endforeach
        ``;

    const row = document.createElement('div');
    row.className = 'item-row';
    row.style.cssText = 'background:#1e2535;border-radius:8px;padding:12px;display:grid;grid-template-columns:1fr 80px 120px 36px;gap:8px;align-items:end;';
    row.innerHTML = `
        <div><label class="form-label">Variante</label><select name="items[${i}][variant_id]" class="form-input variant-select" onchange="updatePrice(this)" required><option value="">Seleccionar...</option>@foreach($variants as $v)<option value="{{ $v->id }}" data-price="{{ $v->sale_price }}">{{ addslashes($v->product->name.' — '.$v->name) }} (${{ number_format($v->sale_price,2) }})</option>@endforeach</select></div>
        <div><label class="form-label">Cantidad</label><input type="number" name="items[${i}][quantity]" class="form-input quantity-input" min="1" value="1" onchange="calcTotal()" required/></div>
        <div><label class="form-label">Precio</label><input type="number" name="items[${i}][price]" class="form-input price-input" step="0.01" min="0" value="0" onchange="calcTotal()" required/></div>
        <div style="padding-bottom:2px;"><button type="button" onclick="removeItem(this)" style="width:34px;height:34px;background:rgba(239,68,68,0.12);border:none;border-radius:6px;cursor:pointer;color:#ef4444;display:flex;align-items:center;justify-content:center;"><span class="material-symbols-outlined" style="font-size:16px;">delete</span></button></div>
    `;
    document.getElementById('itemsContainer').appendChild(row);
}

function removeItem(btn) {
    const rows = document.querySelectorAll('.item-row');
    if (rows.length > 1) { btn.closest('.item-row').remove(); calcTotal(); }
}

function updatePrice(select) {
    const opt = select.options[select.selectedIndex];
    const price = opt.dataset.price || 0;
    const row = select.closest('.item-row');
    row.querySelector('.price-input').value = parseFloat(price).toFixed(2);
    calcTotal();
}

function calcTotal() {
    let subtotal = 0;
    document.querySelectorAll('.item-row').forEach(row => {
        const qty   = parseFloat(row.querySelector('.quantity-input')?.value || 0);
        const price = parseFloat(row.querySelector('.price-input')?.value || 0);
        subtotal += qty * price;
    });
    const tax   = subtotal * 0.13;
    const total = subtotal + tax;
    document.getElementById('subtotalDisplay').textContent = '$' + subtotal.toFixed(2);
    document.getElementById('taxDisplay').textContent     = '$' + tax.toFixed(2);
    document.getElementById('totalDisplay').textContent   = '$' + total.toFixed(2);
}
</script>
@endpush
@endsection
