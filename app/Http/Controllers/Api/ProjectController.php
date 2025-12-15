<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::get();
        if($projects->count() > 0)
        {
            return ProjectResource::collection($projects);
        }
        else
        {
            return response()->json(['message' => 'No record available'], 200);
        }
    }

     public function store(Request $request)
    {
        $validator =Validator::make($request->all(),[
                            'title' => 'required|string|max:255',
                            'status' => 'required|in:ongoing,completed,archived',
                            'description' => 'required',
                        ]);
        
        if($validator->fails())
        {
            return response()->json([
                'message' => 'All fields are mandatory',
                'error' => $validator->messages(),
            ],422);
        }

        $project = Project::create([
            'title' => $request->title,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return response()->json([
            'message' => 'Project Created Successfully',
            'data' => new ProjectResource($project)
        ],200);
    }

     public function show(Project $project)
    {
        return new ProjectResource($project);
    }

     public function update(Request $request, Project $project)
{
    // Merge JSON payload into request to ensure Laravel sees it
    $request->merge($request->json()->all());

    // Validate fields
    $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255',
        'status' => 'required|in:ongoing,completed,archived',
        'description' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'All fields are mandatory',
            'error' => $validator->messages(),
        ], 422);
    }

    // Update project
    $project->update([
        'title' => $request->title,
        'status' => $request->status,
        'description' => $request->description,
    ]);

    return response()->json([
        'message' => 'Project Updated Successfully',
        'data' => new ProjectResource($project)
    ], 200);
}

     public function destroy(Project $project)
    {
        $project->delete();
         return response()->json([
            'message' => 'Project Deleted Successfully',
        ],200);
    }
    
}
