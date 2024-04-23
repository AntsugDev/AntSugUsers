<?php


namespace App\Http\Api\Users\Resource;

use App\Http\Api\Utils\BaseResource;

class UserResource extends BaseResource
{

    public function toArray($request)
    {
        return [
            "id" => $this->resource->id,
            "first_name" => $this->resource->first_name,
            "last_name" => $this->resource->last_name,
            "email" => $this->resource->email,
            "created_at" => $this->convertDate($this->resource->created_at),
            "updated_at" => $this->convertDate($this->resource->updated_at),
            "role_id" => $this->resource->role_id,
            "role" => $this->whenLoaded('role',function ()use($request){
                if(!is_null($this->resource->role))
                    return (new RoleResource($this->resource->role))->toArray($request);
                return null;
            })
        ];
    }
}
