<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;



class ProjectController extends Controller
{
          use ApiResponse; 
    /**
     * Display a listing of the resource.
     */

    public function index()
{
    $projects = Project::with('images')->get();
    return response()->json($projects);
}


    /**
     * Store a newly created resource in storage.
     */
       public function store(Request $request)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'status' => 'required|in:pending,in_progress,completed',
        'priority' => 'required|in:low,medium,high',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'budget' => 'required|numeric',
        'images' => 'nullable|array',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $project = Project::create([
        'title' => $data['title'],
        'description' => $data['description'],
        'status' => $data['status'],
        'priority' => $data['priority'],
        'start_date' => $data['start_date'],
        'end_date' => $data['end_date'],
        'budget' => $data['budget'],
        'owner_id' => auth()->id(),
        'updated_by' => auth()->id(),
    ]);

    if ($request->has('images')) {
        foreach ($request->file('images') as $image) {
            $path = $image->store('projects');
            $project->images()->create(['path' => $path]);
        }
    }

    // return response()->json($project, 201);
         return $this->success($project, 'تمّ حذف الحساب البنكي', 200);

}
    /**
     * Display the specified resource.
     */
    public function show(Project $project)
{
    return response()->json($project->load('images'));
}


    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Project $project)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'status' => 'required|in:pending,in_progress,completed',
        'priority' => 'required|in:low,medium,high',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'budget' => 'required|numeric',
        'images' => 'nullable|array',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $project->update($data);

    if ($request->has('images')) {
        foreach ($request->file('images') as $image) {
            $path = $image->store('projects', 'public');
            $project->images()->create(['path' => $path]);
        }
    }

    // return response()->json($project);
     return $this->success($project, 'تمّ حذف الحساب البنكي');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
{
    $project->images()->delete(); // Delete associated images
    $project->delete(); // Delete the project
    return response()->json(null, 204);
}

public function destroyImage(Project $project, Image $image)
{
    $image->delete(); // This will also delete the file from storage if you have set up the model to handle it
    return response()->json(null, 204);
}

}
