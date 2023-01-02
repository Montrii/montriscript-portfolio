<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ProjectsController extends Controller
{
    //
    public function updateProjectStatus(Request $request): \Illuminate\Http\JsonResponse
    {
        if(Cache::has($request->title))
        {
            $project = Cache::get($request->title);
            $project->online = $request->state;
            $project->description = $request->description;
            $project->save();
            Cache::put($request->title, $project, Carbon::now()->addMinutes(60));

            if(Cache::has('projects'))
            {
                $allProjects = Cache::get('projects');
                $allProjects[count($allProjects)-1] = $project;
                Cache::put('projects', $allProjects, Carbon::now()->addMinutes(60));
                return response()->json(['status' => true, 'message' => 'Project status updated. (Inside Cache - projects)']);
            }
            else
            {
                $allProjects = Projects::all();
                Cache::put('projects', $allProjects, Carbon::now()->addMinutes(60));
                return response()->json(['status' => true, 'message' => 'Project status updated. (Inside Cache - no projects)']);
            }

        }
        else
        {
            $project = Projects::all()->where('title', $request->title)->first();
            if($project === null)
            {
                return response()->json(['status' => false, 'message' => 'Project not found.']);
            }
            else
            {
                $project->update(['online' => $request->state, 'description' => $request->description]);
                Cache::put($request->title, $project, Carbon::now()->addMinutes(60));
                return response()->json(['status' => true, 'message' => 'Project found. (Not in Cache)']);
            }
        }

    }


    public function refreshProjectData(): \Illuminate\Http\JsonResponse
    {
        $projects = null;
        if(Cache::has('projects'))
        {
            $projects = Cache::get('projects');
            Log::debug('Cache hit');
        }
        else
        {
            Log::debug("Cache not found, fetching from database and adding to cache.");
            $projects = Projects::all();
            Cache::put('projects', $projects, Carbon::now()->addMinutes(60));
        }

        return response()->json(['projects' => $projects]);
    }
}
