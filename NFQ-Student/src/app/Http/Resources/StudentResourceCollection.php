<?php

namespace App\Http\Resources;

use App\Models\Group;
use App\Models\Project;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\ProjectResource;

class StudentResourceCollection extends ResourceCollection
{

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'data' => $this->collection,
        ];
    }
}
