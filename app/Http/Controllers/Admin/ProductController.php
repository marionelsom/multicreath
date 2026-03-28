<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'variants']);
        if ($request->search) {
            $query->where('name', 'like', "%{$request->search}%");
        }
        if ($request->category) {
            $query->where('category_id', $request->category);
        }
        $products   = $query->latest()->paginate(15);
        $categories = Category::where('type', 'product')->get();
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('type', 'product')->get();
        $units      = Unit::all();
        $suppliers  = Supplier::all();
        return view('admin.products.create', compact('categories', 'units', 'suppliers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'unit_id'     => 'required|exists:units,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'description' => 'nullable|string',
            'type'        => 'required|in:blanco,personalizacion',
            'image_url'   => 'nullable|url',
        ]);
        $product = Product::create($data);
        return redirect()->route('admin.products.show', $product)->with('success', 'Producto creado exitosamente.');
    }

    public function show(Product $product)
    {
        $product->load(['category', 'unit', 'supplier', 'variants.inventoryMovements']);
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::where('type', 'product')->get();
        $units      = Unit::all();
        $suppliers  = Supplier::all();
        return view('admin.products.edit', compact('product', 'categories', 'units', 'suppliers'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'unit_id'     => 'required|exists:units,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'description' => 'nullable|string',
            'type'        => 'required|in:blanco,personalizacion',
            'image_url'   => 'nullable|url',
            'active'      => 'boolean',
        ]);
        $product->update($data);
        return redirect()->route('admin.products.show', $product)->with('success', 'Producto actualizado.');
    }

    public function destroy(Product $product)
    {
        $product->update(['active' => false]);
        return redirect()->route('admin.products.index')->with('success', 'Producto desactivado.');
    }

    // Variant methods
    public function storeVariant(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'             => 'required|string|max:255',
            'sku'              => 'required|string|unique:product_variants,sku',
            'size'             => 'nullable|string',
            'color'            => 'nullable|string',
            'material'         => 'nullable|string',
            'sublimation_type' => 'nullable|string',
            'cost_price'       => 'required|numeric|min:0',
            'sale_price'       => 'required|numeric|min:0',
            'stock'            => 'required|integer|min:0',
            'min_stock'        => 'required|integer|min:0',
        ]);
        $product->variants()->create($data);
        return back()->with('success', 'Variante agregada.');
    }

    public function updateVariant(Request $request, ProductVariant $variant)
    {
        $data = $request->validate([
            'name'             => 'required|string|max:255',
            'cost_price'       => 'required|numeric|min:0',
            'sale_price'       => 'required|numeric|min:0',
            'min_stock'        => 'required|integer|min:0',
            'size'             => 'nullable|string',
            'color'            => 'nullable|string',
            'material'         => 'nullable|string',
            'sublimation_type' => 'nullable|string',
            'active'           => 'boolean',
        ]);
        $variant->update($data);
        return back()->with('success', 'Variante actualizada.');
    }
}
