<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerType;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::with('type');
        if ($request->search) {
            $query->where('full_name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%")
                  ->orWhere('phone', 'like', "%{$request->search}%");
        }
        $customers = $query->latest()->paginate(15);
        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        $types = CustomerType::all();
        return view('admin.customers.create', compact('types'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name'        => 'required|string|max:255',
            'email'            => 'nullable|email|max:255',
            'phone'            => 'required|string|max:30',
            'address'          => 'nullable|string',
            'customer_type_id' => 'nullable|exists:customer_types,id',
            'nit'              => 'nullable|string|max:50',
            'company_name'     => 'nullable|string|max:255',
            'contact_person'   => 'nullable|string|max:255',
            'credit_limit'     => 'nullable|numeric|min:0',
        ]);
        $customer = Customer::create($data);
        return redirect()->route('admin.customers.show', $customer)->with('success', 'Cliente creado.');
    }

    public function show(Customer $customer)
    {
        $customer->load(['type', 'orders', 'projects', 'invoices']);
        return view('admin.customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        $types = CustomerType::all();
        return view('admin.customers.edit', compact('customer', 'types'));
    }

    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'full_name'        => 'required|string|max:255',
            'email'            => 'nullable|email|max:255',
            'phone'            => 'required|string|max:30',
            'address'          => 'nullable|string',
            'customer_type_id' => 'nullable|exists:customer_types,id',
            'nit'              => 'nullable|string|max:50',
            'company_name'     => 'nullable|string|max:255',
            'contact_person'   => 'nullable|string|max:255',
            'credit_limit'     => 'nullable|numeric|min:0',
            'active'           => 'boolean',
        ]);
        $customer->update($data);
        return redirect()->route('admin.customers.show', $customer)->with('success', 'Cliente actualizado.');
    }
}
