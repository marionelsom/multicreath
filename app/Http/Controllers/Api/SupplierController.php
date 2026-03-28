<?php

namespace App\Http\Controllers\Api;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $query = Supplier::query();

        if ($request->has('product_category')) {
            $query->where('product_category', $request->product_category);
        }

        return $query->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string',
            'contact_person' => 'nullable|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'address' => 'nullable|string',
            'product_category' => 'required|string',
        ]);

        $supplier = Supplier::create($validated);
        return response()->json($supplier, 201);
    }

    public function show(Supplier $supplier)
    {
        return $supplier;
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'company_name' => 'string',
            'contact_person' => 'nullable|string',
            'phone' => 'string',
            'email' => 'email',
            'address' => 'nullable|string',
            'product_category' => 'string',
        ]);

        $supplier->update($validated);
        return $supplier;
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return response()->json(null, 204);
    }
}