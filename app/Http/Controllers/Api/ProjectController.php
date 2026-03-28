<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::query();

        if ($request->has('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        return $query->with('customer', 'services')->orderBy('created_at', 'desc')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|in:propuesta,en_proceso,completado,cancelado',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'budget' => 'required|numeric|min:0',
        ]);

        $project = Project::create($validated);
        return response()->json($project, 201);
    }

    public function show(Project $project)
    {
        return $project->load('customer', 'services', 'movements');
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'string',
            'description' => 'nullable|string',
            'status' => 'in:propuesta,en_proceso,completado,cancelado',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'budget' => 'numeric|min:0',
        ]);

        $project->update($validated);
        return $project;
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json(null, 204);
    }
}