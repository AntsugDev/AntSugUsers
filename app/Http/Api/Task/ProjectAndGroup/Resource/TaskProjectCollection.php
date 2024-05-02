<?php

namespace App\Http\Api\Task\ProjectAndGroup\Resource;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Symfony\Component\HttpFoundation\Request;

class TaskProjectCollection extends ResourceCollection
{
    public $collects = TaskProjectResource::class;

    public $resource = 'task_project_group';

    public function toArray(Request $request):array
    {
        return TaskProjectResource::collection($this->collection)->toArray($request);
    }
}
