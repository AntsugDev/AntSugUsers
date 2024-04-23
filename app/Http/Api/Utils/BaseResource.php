<?php

namespace App\Http\Api\Utils;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
    protected function convertDate(string|null $resource): ?string
    {
        if(!is_null($resource))
            return Carbon::parse($resource)->format('d/m/Y H:i:s');

        return  null;
    }


}
