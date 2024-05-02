<?php


namespace App\Http\Api\Users\Resource;

use App\Http\Api\Google\Resource\GoogleAccessResource;
use App\Http\Api\Utils\BaseResource;
use App\Models\Google\AccessGoogle;
use App\Models\Google\GoogleAccess;

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
            }),
            "google_account" => $this->resource->google_account,
            "access" => $this->when($this->resource->google_account,function () use ($request){
                return ( new GoogleAccessResource(GoogleAccess::where('user_id',$this->resource->id)->first()))->toArray($request);
            })
        ];
    }
}
