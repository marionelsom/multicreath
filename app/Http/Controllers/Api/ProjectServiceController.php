<?php

namespace App\Http\Controllers\Api;

use App\Models\ProjectService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = ProjectService::query();

        if ($request->has('project_id')) {
            $query->where('project_id', $request->project_id);
        }

        return $query->with('project', 'serviceVariant')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'service_variant_id' => 'required|exists:service_variants,id',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'status' => 'required|in:pendiente,en_proceso,completado',
        ]);

        $validated['subtotal'] = $validated['quantity'] * $validated['unit_price'];

        $service = ProjectService::create($validated);
        return response()->json($service, 201);
    }

    public function show(ProjectService $projectService)
    {
        return $projectService->load('project', 'serviceVariant');
    }

    public function update(Request $request, ProjectService $projectService)
    {
        $validated = $request->validate([
            'quantity' => 'integer|min:1',
            'unit_price' => 'numeric|min:0',
            'status' => 'in:pendiente,en_proceso,completado',
        ]);

        if (isset($validated['quantity']) || isset($validated['unit_price'])) {
            $quantity = $validated['quantity'] ?? $projectService->quantity;
            $unitPrice = $validated['unit_price'] ?? $projectService->unit_price;
            $validated['subtotal'] = $quantity * $unitPrice;
        }

        $projectService->update($validated);
        return $projectService;
    }

    public function destroy(ProjectService $projectService)
    {
        $projectService->delete();
        return response()->json(null, 204);
    }
}