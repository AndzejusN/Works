<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResourceCollection;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ProjectResourceCollection
     */
    public function index()
    {
        $projects = Project::get();

        return new ProjectResourceCollection($projects);
    }



}
