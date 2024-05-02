<?php

namespace App\Http\Api\Google\Resource;

use App\Http\Api\Utils\BaseResource;
use Illuminate\Http\Request;

class GoogleAccessResource extends BaseResource
{

    public function toArray(Request $request)
    {
        return [
          "id" => $this->resource->id,
          "payload" => $this->resource->payload
        ];
    }

}
