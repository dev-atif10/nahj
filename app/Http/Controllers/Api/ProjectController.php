<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use App\Models\Project;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;



class ProjectController extends Controller
{
    use ApiResponse; 
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $projects = Project::with('images')->get();
        return $this->success($projects, 'قائمة المشاريع', 200);
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

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('projects', 'public'); // use public disk consistently
                $project->images()->create(['path' => $path]);
            }
        }

        return $this->success($project, 'تم إنشاء المشروع', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return $this->success($project->load('images'), 'تفاصيل المشروع', 200);
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

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('projects', 'public');
                $project->images()->create(['path' => $path]);
            }
        }

        return $this->success($project->load('images'), 'تم تحديث المشروع', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // delete files for each image
        foreach ($project->images as $img) {
            if (Storage::disk('public')->exists($img->path)) {
                Storage::disk('public')->delete($img->path);
            }
        }
        $project->images()->delete();
        $project->delete();
        return $this->success(null, 'تم حذف المشروع', 204);
    }

    public function destroyImage(Project $project, Image $image)
    {
        if ($image->project_id !== $project->id) {
            return $this->error('الصورة لا تنتمي لهذا المشروع', 404);
        }

        if (Storage::disk('public')->exists($image->path)) {
            Storage::disk('public')->delete($image->path);
        }

        $image->delete();
        return $this->success(null, 'تم حذف الصورة', 204);
    }

}
