<?php

namespace App\Http\Api\Task\ProjectAndGroup\Resource;

use App\Http\Api\Utils\BaseResource;
use Illuminate\Http\Request;

class TaskProjectResource extends BaseResource
{
    public function toArray(Request $request)
    {
        return [
            "id" => $this->resource->id,
            "name" => $this->resource->name,
            "created_at" => $this->convertDate($this->resource->created_at),
            "updated_at" => $this->convertDate($this->resource->updated_at),
        ];
    }
}
