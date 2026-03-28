<?php

namespace App\Http\Controllers\Api;

use App\Models\Quotation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuotationController extends Controller
{
    public function index(Request $request)
    {
        $query = Quotation::query();

        if ($request->has('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        return $query->with('customer')->orderBy('created_at', 'desc')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'quotation_number' => 'required|string|unique:quotations',
            'type' => 'required|in:producto,servicio,mixto',
            'status' => 'required|in:borrador,enviado,aceptado,rechazado',
            'items' => 'required|json',
            'subtotal' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'valid_until' => 'required|date',
        ]);

        $quotation = Quotation::create($validated);
        return response()->json($quotation, 201);
    }

    public function show(Quotation $quotation)
    {
        return $quotation->load('customer');
    }

    public function update(Request $request, Quotation $quotation)
    {
        $validated = $request->validate([
            'status' => 'in:borrador,enviado,aceptado,rechazado',
            'items' => 'json',
            'subtotal' => 'numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'total' => 'numeric|min:0',
            'valid_until' => 'date',
        ]);

        $quotation->update($validated);
        return $quotation;
    }

    public function destroy(Quotation $quotation)
    {
        $quotation->delete();
        return response()->json(null, 204);
    }
}