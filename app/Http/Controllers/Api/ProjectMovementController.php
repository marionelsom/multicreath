<?php

namespace App\Http\Controllers\Api;

use App\Models\ProjectMovement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectMovementController extends Controller
{
    public function index(Request $request)
    {
        $query = ProjectMovement::query();

        if ($request->has('project_id')) {
            $query->where('project_id', $request->project_id);
        }

        return $query->with('project')->orderBy('created_at', 'desc')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'type' => 'required|in:inicio,progreso,entrega,cambio,pausa,completado',
            'description' => 'nullable|string',
        ]);

        $movement = ProjectMovement::create($validated);
        return response()->json($movement, 201);
    }

    public function show(ProjectMovement $projectMovement)
    {
        return $projectMovement->load('project');
    }

    public function destroy(ProjectMovement $projectMovement)
    {
        $projectMovement->delete();
        return response()->json(null, 204);
    }
}