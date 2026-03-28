<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();

        if ($request->has('customer_type_id')) {
            $query->where('customer_type_id', $request->customer_type_id);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('full_name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('phone', 'like', "%$search%");
        }

        return $query->with('customerType')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email|unique:customers',
            'phone' => 'required|string',
            'address' => 'nullable|string',
            'customer_type_id' => 'nullable|exists:customer_types,id',
            'nit' => 'nullable|string|unique:customers',
            'company_name' => 'nullable|string',
            'contact_person' => 'nullable|string',
            'credit_limit' => 'nullable|numeric|min:0',
        ]);

        $customer = Customer::create($validated);
        return response()->json($customer, 201);
    }

    public function show(Customer $customer)
    {
        return $customer->load('customerType', 'orders', 'projects');
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'full_name' => 'string',
            'email' => 'email|unique:customers,email,' . $customer->id,
            'phone' => 'string',
            'address' => 'nullable|string',
            'customer_type_id' => 'nullable|exists:customer_types,id',
            'nit' => 'nullable|string|unique:customers,nit,' . $customer->id,
            'company_name' => 'nullable|string',
            'contact_person' => 'nullable|string',
            'credit_limit' => 'nullable|numeric|min:0',
        ]);

        $customer->update($validated);
        return $customer;
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json(null, 204);
    }
}