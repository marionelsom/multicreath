<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceVariant;
use App\Models\Category;
use App\Models\Unit;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::with(['category', 'variants']);
        if ($request->search) {
            $query->where('name', 'like', "%{$request->search}%");
        }
        $services = $query->latest()->paginate(15);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $categories = Category::where('type', 'service')->get();
        $units      = Unit::all();
        return view('admin.services.create', compact('categories', 'units'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'unit_id'     => 'required|exists:units,id',
            'description' => 'nullable|string',
        ]);
        $service = Service::create($data);
        return redirect()->route('admin.services.show', $service)->with('success', 'Servicio creado.');
    }

    public function show(Service $service)
    {
        $service->load(['category', 'unit', 'variants']);
        return view('admin.services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        $categories = Category::where('type', 'service')->get();
        $units      = Unit::all();
        return view('admin.services.edit', compact('service', 'categories', 'units'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'unit_id'     => 'required|exists:units,id',
            'description' => 'nullable|string',
            'active'      => 'boolean',
        ]);
        $service->update($data);
        return redirect()->route('admin.services.show', $service)->with('success', 'Servicio actualizado.');
    }

    public function storeVariant(Request $request, Service $service)
    {
        $data = $request->validate([
            'name'               => 'required|string|max:255',
            'sku'                => 'nullable|string',
            'cost_price'         => 'required|numeric|min:0',
            'sale_price'         => 'required|numeric|min:0',
            'delivery_days'      => 'required|integer|min:1',
            'revisions_included' => 'required|integer|min:0',
            'features'           => 'nullable|string',
        ]);

        if (!empty($data['features'])) {
            $features = [];
            foreach (explode("\n", $data['features']) as $line) {
                $line = trim($line);
                if ($line) $features[] = $line;
            }
            $data['features'] = $features;
        }

        $service->variants()->create($data);
        return back()->with('success', 'Paquete agregado al servicio.');
    }
}
