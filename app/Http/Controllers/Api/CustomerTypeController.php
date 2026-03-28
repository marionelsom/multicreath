<?php

namespace App\Http\Controllers\Api;

use App\Models\CustomerType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerTypeController extends Controller
{
    public function index()
    {
        return CustomerType::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:customer_types',
            'discount_percentage' => 'required|numeric|min:0|max:100',
        ]);

        $type = CustomerType::create($validated);
        return response()->json($type, 201);
    }

    public function show(CustomerType $customerType)
    {
        return $customerType;
    }

    public function update(Request $request, CustomerType $customerType)
    {
        $validated = $request->validate([
            'name' => 'string|unique:customer_types,name,' . $customerType->id,
            'discount_percentage' => 'numeric|min:0|max:100',
        ]);

        $customerType->update($validated);
        return $customerType;
    }

    public function destroy(CustomerType $customerType)
    {
        $customerType->delete();
        return response()->json(null, 204);
    }
}