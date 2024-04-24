<?php

namespace App\Http\Api\Pagination\Resource;

use App\Http\Api\Utils\BaseResource;
use Illuminate\Http\Request;

class CitiesResource extends BaseResource
{

    public function toArray(Request $request)
    {
        return [
            "denominazione" => $this->resource->denominazione,
            "regione" => $this->resource->regione,
            "provinicia" => $this->resource->provinicia,
            "codice_catastale" => $this->resource->codice_catastale,
            "created_at" => ($this->resource->created_at),
            "updated_at" =>  ($this->resource->updated_at),
        ];
    }

}
