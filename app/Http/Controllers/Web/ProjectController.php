<?php
namespace App\Http\Controllers\Web; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $projects = Project::with('images')->latest()->paginate(12);
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

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

        // Exclude images from project attributes so we don't try to insert array into projects table
        $projectData = $data;
        if (isset($projectData['images'])) {
            unset($projectData['images']);
        }

        $project = Project::create(array_merge($projectData, [
             'owner_id' => auth()->id(),
             'updated_by' => auth()->id(),
         ]));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('projects', 'public');
                $project->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('projects.index')->with('success', 'تم إنشاء المشروع');
    }

    public function show(Project $project)
    {
        $project->load('images');
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

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

        // Remove images key before updating project columns
        $projectUpdate = $data;
        if (isset($projectUpdate['images'])) {
            unset($projectUpdate['images']);
        }

        $project->update($projectUpdate);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('projects', 'public');
                $project->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('projects.show', $project)->with('success', 'تم تحديث المشروع');
    }

    public function destroy(Project $project)
    {
        foreach ($project->images as $img) {
            if (Storage::disk('public')->exists($img->path)) {
                Storage::disk('public')->delete($img->path);
            }
        }
        $project->images()->delete();
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'تم حذف المشروع');
    }

    public function destroyImage(Project $project, Image $image)
    {
        if ($image->project_id !== $project->id) {
            return back()->withErrors('الصورة لا تنتمي لهذا المشروع');
        }

        if (Storage::disk('public')->exists($image->path)) {
            Storage::disk('public')->delete($image->path);
        }

        $image->delete();

        return back()->with('success', 'تم حذف الصورة');
    }
}