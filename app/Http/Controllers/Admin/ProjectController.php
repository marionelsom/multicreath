<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectMovement;
use App\Models\Customer;
use App\Models\ServiceVariant;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with('customer');
        if ($request->search) {
            $query->where('title', 'like', "%{$request->search}%")
                  ->orWhereHas('customer', fn($q) => $q->where('full_name', 'like', "%{$request->search}%"));
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        $projects = $query->latest()->paginate(15);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $customers = Customer::where('active', true)->orderBy('full_name')->get();
        $variants  = ServiceVariant::with('service')->where('active', true)->get();
        return view('admin.projects.create', compact('customers', 'variants'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date'  => 'nullable|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'budget'      => 'nullable|numeric|min:0',
        ]);

        $project = Project::create($data + ['status' => 'propuesta']);

        ProjectMovement::create([
            'project_id'  => $project->id,
            'type'        => 'inicio',
            'description' => 'Proyecto creado en el sistema.',
        ]);

        return redirect()->route('admin.projects.show', $project)->with('success', 'Proyecto creado.');
    }

    public function show(Project $project)
    {
        $project->load(['customer', 'services.serviceVariant.service', 'movements', 'invoices']);
        $variants = ServiceVariant::with('service')->where('active', true)->get();
        return view('admin.projects.show', compact('project', 'variants'));
    }

    public function edit(Project $project)
    {
        $customers = Customer::where('active', true)->orderBy('full_name')->get();
        return view('admin.projects.edit', compact('project', 'customers'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date'  => 'nullable|date',
            'end_date'    => 'nullable|date',
            'budget'      => 'nullable|numeric|min:0',
            'status'      => 'required|in:propuesta,en_proceso,completado,cancelado',
        ]);
        $project->update($data);
        return redirect()->route('admin.projects.show', $project)->with('success', 'Proyecto actualizado.');
    }

    public function addMovement(Request $request, Project $project)
    {
        $data = $request->validate([
            'type'        => 'required|in:inicio,progreso,entrega,cambio,pausa,completado',
            'description' => 'required|string',
        ]);
        $project->movements()->create($data);
        return back()->with('success', 'Movimiento registrado.');
    }

    public function addService(Request $request, Project $project)
    {
        $data = $request->validate([
            'service_variant_id' => 'required|exists:service_variants,id',
            'quantity'           => 'required|integer|min:1',
            'unit_price'         => 'required|numeric|min:0',
        ]);
        $data['subtotal'] = $data['quantity'] * $data['unit_price'];
        $project->services()->create($data);
        return back()->with('success', 'Servicio agregado al proyecto.');
    }
}
