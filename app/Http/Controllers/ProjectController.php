<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostProjectRequest;
use App\Models\Image;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::where('accept', true)->latest('date')->paginator(20);
        if (!count($projects) === 0) {
            return response()->json(['message' => 'empty projects !'], 400);
        }
        return response()->json(['message' => 'the projects is not empty', 'data' => $projects], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostProjectRequest $request)
    {
        $project = new Project($request->only(['name', 'description', 'time_first', 'notes', 'time_function', 'additional_file', 'value', 'funds', 'city_id', 'description_location', 'accept', 'user_id', 'worker_id']));
        $result = $project->save();
        $result_image = false;

        if ($request->hasFile('images')) {
            $imagesFiles = $request->file('images');

            foreach ($imagesFiles as $image) {

                $imagePath = $image->store('project_img/projects', 'local');
                $img = new Image();
                $img->image_url = $imagePath;
                $img->slug = $project->slug;

                $result_image = $project->images()->save($img);
            }
        }

        // Check if the project and images were saved successfully
        if ($result && $result_image) {
            // Redirect or return a success response
            return response()->json(['success', 'Project and images stored successfully'], 201);
        } else {
            // Redirect or return an error response
            return response()->json(['error', 'Failed to store project and images'], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
