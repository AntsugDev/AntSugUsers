<?php

namespace App\Http\Api\Google\Resource;

use App\Http\Api\Utils\BaseResource;
use Illuminate\Http\Request;

class AccessGoogleResource extends BaseResource
{

    public function toArray(Request $request)
    {
        return [
            "id" => $this->resource->id,
            "uuid" => $this->resource->uuid,
            "email" => $this->resource->email,
            "name" => $this->resource->name,
            "created_at" => $this->convertDate($this->resource->created_at),
            "updated_at" => $this->convertDate($this->resource->updated_at),
        ];
    }
}
