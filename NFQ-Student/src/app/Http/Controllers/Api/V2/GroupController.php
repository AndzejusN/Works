<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Resources\GroupResourceCollection;
use App\Models\Group;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return GroupResourceCollection
     */
    public function index()
    {
        $groups = Group::with(['project_id'])->get();

        return new GroupResourceCollection($groups);
    }



}
