<?php

namespace App\Http\Api\Pagination\Resource;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Symfony\Component\HttpFoundation\Request;

class CitiesCollection extends ResourceCollection
{
    public $collects = CitiesResource::class;

    public $resource = 'cities';

    public function toArray(Request $request):array
    {
        return CitiesResource::collection($this->collection)->toArray($request);
    }
}
