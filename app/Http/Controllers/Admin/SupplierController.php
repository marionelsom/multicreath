<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $query = Supplier::withCount('products');
        if ($request->search) {
            $query->where('company_name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%");
        }
        $suppliers = $query->latest()->paginate(15);
        return view('admin.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('admin.suppliers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'company_name'    => 'required|string|max:255',
            'contact_person'  => 'nullable|string|max:255',
            'phone'           => 'required|string|max:30',
            'email'           => 'nullable|email|max:255',
            'address'         => 'nullable|string',
            'product_category'=> 'nullable|string|max:255',
        ]);
        $supplier = Supplier::create($data);
        return redirect()->route('admin.suppliers.index')->with('success', 'Proveedor creado.');
    }

    public function edit(Supplier $supplier)
    {
        return view('admin.suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $data = $request->validate([
            'company_name'    => 'required|string|max:255',
            'contact_person'  => 'nullable|string|max:255',
            'phone'           => 'required|string|max:30',
            'email'           => 'nullable|email|max:255',
            'address'         => 'nullable|string',
            'product_category'=> 'nullable|string|max:255',
        ]);
        $supplier->update($data);
        return redirect()->route('admin.suppliers.index')->with('success', 'Proveedor actualizado.');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('admin.suppliers.index')->with('success', 'Proveedor eliminado.');
    }
}
