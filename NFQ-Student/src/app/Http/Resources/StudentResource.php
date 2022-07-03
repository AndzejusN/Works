<?php

namespace App\Http\Resources;

use App\Models\Group;
use App\Models\Project;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {

        $group = Group::find($this->group_id);
        $project = Project::find($this->project_id);

        return [
            'id' => $this->id,
            'group' => new GroupResource($group),
            'project' => new ProjectResource($project)
        ];
    }
}
